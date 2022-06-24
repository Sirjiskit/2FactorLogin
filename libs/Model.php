<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author Jiskit
 */
class Model {

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    function getStringBetween($string, $start, $end) {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0)
            return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    function base64ToImageFile($base64String, $ext, $uploadDirectory) {
        $filenamePath = md5(time() . uniqid()) . "." . $ext;
        $decoded = base64_decode($base64String);
        file_put_contents($uploadDirectory . "/" . $filenamePath, $decoded);

        return $filenamePath;
    }

    function make_avatar($character, $link) {
        $path = time() . ".png";
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);

        $font = PUBLIC_DIR . '/font/arial.ttf';

        imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
        imagepng($image, UPLOAD_DIR . $link . $path);
        imagedestroy($image);
        return $path;
    }

    public function sendEmail($email, $name, $subject, $body) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP(true);
        $mail->Host = "localhost";
        $mail->SMTPDebug = 0;
        $mail->Port = 25; //465 or 587
        //$mail->SMTPSecure = 'ssl';
        //$mail->SMTPAuth = true;
        //Authentication
        $mail->Username = "localhost";
        //$mail->Username = "jigbashio@gmail.com";
        //$mail->Password = "********";
        $mail->addAddress('info@domain.com');
        $mail->setFrom($email, $name);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->msgHTML(preg_replace('/\\\\/', '', $body));
        $mail->addReplyTo($email);
        $mail->AllowEmpty = true;
        $mail->isHTML(true);
        if (!$mail->send()):
            return $mail->ErrorInfo;
        endif;
        return 'send';
    }


}
