<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @author Jiskit
 */
use Twilio\Rest\Client;

class index extends Controller {

    private $service;

    //put your code here
    public function __construct() {
        error_reporting(E_ERROR);
        parent::__construct();
        // Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
//        $sid = "AC226c424f5b4d4b905bda297a6edfc248";
//        $token = "80fb99c83388a5e3b156830cdbe2252f";
//        $this->service = $sid;
//        $twilio = new Client($sid, $token);
//        try {
//            $twilio->messages->create(
//                    // Where to send a text message (your cell phone?)
//                    '+2349123856264',
//                    array(
//                        'from' => '+18049938415',
//                        'body' => 'I sent this message in under 10 minutes!'
//                    )
//            );
//        } catch (TwilioException $e) {
//            Log::error(
//                    'Could not send SMS notification.' .
//                    ' Twilio replied with: ' . $e
//            );
//        }
    }

    function index() {
        Session::init();
        if (Session::get('loggedIn')):
            $this->view->title = 'Welcome Page';
            $this->view->render('index/index');
        else:
            $this->view->customlibrary = array("index/js/login");

            $this->view->data = $this->service->sid;
            $this->view->title = 'Login Page';
            $this->view->render('index/login');
        endif;
    }

}
