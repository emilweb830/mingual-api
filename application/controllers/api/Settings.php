<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Settings extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Setting');
    }

    public function index_get()
    {
    	$id_user = $this->get('id');

    	if( $id_user == NULL )
    	{
    		$this->response([
                'status' => FALSE,
                'message' => 'Setting could not be found'
            ], REST_Controller::HTTP_NOT_FOUND, true); // NOT_FOUND (404) being the HTTP response code
    	}
		
		$id_user = (int) $id_user;
		if ( $id_user <= 0 )
        {
            // Invalid id, set the response and exit.
            $this->response( NULL, REST_Controller::HTTP_BAD_REQUEST, true); // BAD_REQUEST (400) being the HTTP response code
        }

        $setting = $this->Setting->getItems( "`id_user`='".$id_user."'", true );
        if (!empty($setting))
        {
            $this->set_response($setting, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => config_item('message_invalid_params')
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    
}

?>