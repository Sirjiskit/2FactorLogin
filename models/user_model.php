<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author Jiskit
 */
class user_model extends Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    private function getDataByEmail($email) {
        return $this->db->selectSingleData("SELECT * FROM `users` WHERE email = '{$email}'");
    }

    private function getDataByPhone($phone) {
        return $this->db->selectSingleData("SELECT * FROM `users` WHERE phone = '{$phone}'");
    }

    public function register($POST) {
        if (!filter_var($POST["email"], FILTER_VALIDATE_EMAIL)):
            die(json_encode(array("status" => 201, "msg" => "Invalid email address")));
        endif;
        if (!filter_var($POST["phone"], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(080|091|090|070|081)+[0-9]{8}$/")))):
            die(json_encode(array("status" => 201, "msg" => "Invalid phone number")));
        endif;
        $OTP = substr(str_shuffle("0123456789"), 0, 6);
        $eData = $this->getDataByEmail($POST["email"]);
        $pData = $this->getDataByPhone($POST["phone"]);
        if ($eData && (empty($eData["otp"]) || $eData["otp"] == null)):
            die(json_encode(array("status" => 201, "msg" => "Email address already exists")));
        endif;
        if ($pData && (empty($eData["otp"]) || $eData["otp"] == null)):
            die(json_encode(array("status" => 201, "msg" => "phone number already exists")));
        endif;
        $data = array_merge($POST, array("otp" => $OTP));
        $option = 1;
        if ($eData && ($eData["otp"] !== "" || !empty($eData["otp"]))):
            $option = 2;
        endif;
        $this->seve($data, $OTP, $option);
    }

    private function seve($POST, $otp, $opt) {
        $html = "<h2>Dear {$POST["name"]}</h2><p>Your one time password is: $otp. Don't share this code with any body</p>";
        $sms = "2FA: Your one time password is: $otp. Don't share this code with any body";

        $expiredIn = strtotime(date("Y-m-d H:i:s") . " + 30 minute");
        $data = array_merge($POST, array("expiredIn" => $expiredIn));
        if ($opt == 2) {
            if ($this->db->update("users", $data, "email = '{$POST["email"]}'")):
                $this->sendEmail($POST["email"], $POST["name"], "2 Factor Authentication", $html);
                $this->sendSMS($sms, $POST["phone"]);
                die(json_encode(array("status" => 200, "msg" => "Account successfully updated")));
            endif;
            die(json_encode(array("status" => 201, "msg" => "Unabled to create account")));
        } else {
            if ($this->db->insert("users", $data)):
                $this->sendSMS($sms, $POST["phone"]);
                $this->sendEmail($POST["email"], $POST["name"], "2 Factor Authentication", $html);
                die(json_encode(array("status" => 200, "msg" => "Account successfully created")));
            endif;
            die(json_encode(array("status" => 201, "msg" => "Unabled to create account")));
        }
    }

    public function verify_register($POST) {
        $eData = $this->getDataByEmail($POST["email"]);
        if (!$eData):
            die(json_encode(array("status" => 201, "msg" => "Unknwon error occurred please try again later")));
        endif;
        if ($eData["otp"] != $POST["otp"]):
            die(json_encode(array("status" => 201, "msg" => "Verification failed")));
        endif;
        if (strtotime(time()) > strtotime($eData["expiredIn"])):
            die(json_encode(array("status" => 201, "msg" => "OPT expired")));
        endif;
        $pass = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);
        $password = Hash::create('sha256', $pass, HASH_PASSWORD_KEY);
        $html = "<h2>Dear {$eData["name"]}</h2><p>Your account successfully created below are your "
                . "login details:<br>Username: {$eData["email"]}<br>Password: {$pass}</p>";
        $sms = "2FA: Your login <br>Username: {$eData["email"]}<br>Password: {$pass}. Don't share this code with any body";
        if ($this->db->update("users", array("otp" => "", "password" => $password), "email = '{$eData["email"]}'")):
            $this->sendSMS($sms, $eData["phone"]);
            $this->sendEmail($eData["email"], $eData["name"], "2 Factor Authentication", $html);
            die(json_encode(array("status" => 200, "msg" => "Account successfully verified")));
        endif;
        die(json_encode(array("status" => 201, "msg" => "Unabled to verify your account")));
    }

    public function verify_login($POST) {
        $eData = $this->getDataByEmail($POST["email"]);
        if (!$eData):
            die(json_encode(array("status" => 201, "msg" => "Unknwon error occurred please try again later")));
        endif;
        if ($eData["otp"] != $POST["otp"]):
            die(json_encode(array("status" => 201, "msg" => "Verification failed")));
        endif;
        if (strtotime(time()) > strtotime($eData["expiredIn"])):
            die(json_encode(array("status" => 201, "msg" => "OPT expired")));
        endif;

        if ($this->db->update("users", array("otp" => ""), "email = '{$eData["email"]}'")):
            Session::init();
            Session::set('loggedIn', true);
            Session::set('id', $eData['id']);
            Session::set('name', $eData['name']);
            Session::set('email', $eData['email']);
            die(json_encode(array("status" => 200, "msg" => "Account successfully verified")));
        endif;
        die(json_encode(array("status" => 201, "msg" => "Unabled to verify your account")));
    }

    public function resent($POST) {
        if (!filter_var($POST["email"], FILTER_VALIDATE_EMAIL)):
            die(json_encode(array("status" => 201, "msg" => "Invalid username")));
        endif;
        $eData = $this->getDataByEmail($POST["email"]);
        if (!$eData):
            die(json_encode(array("status" => 201, "msg" => "Invalid username or password")));
        endif;
        $expiredIn = strtotime(date("Y-m-d H:i:s") . " + 30 minute");
        $OTP = substr(str_shuffle("0123456789"), 0, 6);
        $data = array_merge(array("expiredIn" => $expiredIn, "otp" => $OTP));
        $html = "<h2>Dear {$eData["name"]}</h2><p>Your one time password is: $OTP. Don't share this code with any body</p>";
        $sms = "2FA: Your one time password is: $OTP. Don't share this code with any body";
        if ($this->db->update("users", $data, "email = '{$POST["email"]}'")):
            $r = $this->sendSMS($sms, $eData["phone"]);
            $this->sendEmail($POST["email"], $eData["name"], "2 Factor Authentication", $html);
            die(json_encode(array("status" => 200, "msg" => "Account successfully updated {$r}")));
        endif;
        die(json_encode(array("status" => 201, "msg" => "Unabled to re-sent otp")));
    }

    public function logCheck($POST) {
        if (!filter_var($POST["email"], FILTER_VALIDATE_EMAIL)):
            die(json_encode(array("status" => 201, "msg" => "Invalid username")));
        endif;
        $eData = $this->getDataByEmail($POST["email"]);
        if (!$eData):
            die(json_encode(array("status" => 201, "msg" => "Invalid username or password")));
        endif;
        if ($eData["password"] != Hash::create('sha256', $POST["password"], HASH_PASSWORD_KEY)):
            die(json_encode(array("status" => 201, "msg" => "Invalid username or password")));
        endif;
        $expiredIn = strtotime(date("Y-m-d H:i:s") . " + 30 minute");
        $OTP = substr(str_shuffle("0123456789"), 0, 6);
        $data = array_merge(array("expiredIn" => $expiredIn, "otp" => $OTP));
        $html = "<h2>Dear {$eData["name"]}</h2><p>Your one time password is: $OTP. Don't share this code with any body</p>";
        $sms = "2FA: Your one time password is: $OTP. Don't share this code with any body";
        if ($this->db->update("users", $data, "email = '{$POST["email"]}'")):
            $r = $this->sendSMS($sms, $eData["phone"]);
            $this->sendEmail($POST["email"], $eData["name"], "2 Factor Authentication", $html);
            die(json_encode(array("status" => 200, "msg" => "Account successfully updated {$r}")));
        endif;
        die(json_encode(array("status" => 201, "msg" => "Unabled to re-sent otp")));
    }

    public function sendSMS($message, $phone) {
        error_reporting(0);
        //allow remote access to this script, replace the * to your domain e.g http://www.example.com if you wish to recieve requests only from your server
        header("Access-Control-Allow-Origin: *");
//rebuild form data
        $postdata = http_build_query(
                array('username' => "jigbashio@gmail.com", 'password' => "@Kalifort015", 'message' => $message, 'mobiles' => $phone, 'sender' => "Dootech")
        );
//prepare a http post request
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
//craete a stream to communicate with betasms api
        $context = stream_context_create($opts);
//get result from communication
        $result = file_get_contents('http://login.betasms.com/api/', false, $context);
//return result to client, this will return the appropriate respond code
        return $result;
    }

}
