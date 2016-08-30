<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Mingual_Controller extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Lang');
        $this->load->model('User');
        $this->load->model('Country');
        $this->load->model('Photo');
        $this->load->model('Mingual');
        $this->load->model('Setting');
        $this->load->model('Report');

        $this->lang->load("api", "english");
    }

    public function checkPermission()
    {
        $headers = getallheaders();
        $token = isset( $headers['Token'])? $headers['Token'] : "";

        $id_user = $this->User->checkLogin( $token );
        if( !$id_user && $token != "" )
        {
            $this->response([
                'status'    => false,
                'message'   => "Invalid Acccess."
            ], REST_Controller::HTTP_OK);
        }

        return $id_user;
    }
}
