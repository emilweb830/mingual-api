<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Languages extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Lang');
    }

    function language_get()
    {
    	$this->response( $this->Lang->getItems() , REST_Controller::HTTP_OK);
    }

    function language_put()
    {
    	
    }
}
?>