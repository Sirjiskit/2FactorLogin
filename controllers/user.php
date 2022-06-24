<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Jiskit
 */
class user extends Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function register() {
        $this->model->register(filter_input_array(INPUT_POST));
    }
    function verify_register() {
        $this->model->verify_register(filter_input_array(INPUT_POST));
    }
    function resent(){
        $this->model->resent(filter_input_array(INPUT_POST));
    }
    function login(){
        $this->model->logCheck(filter_input_array(INPUT_POST));
    }
    function verify_login() {
         $this->model->verify_login(filter_input_array(INPUT_POST));
    }
}
