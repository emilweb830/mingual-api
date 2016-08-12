<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Users extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('User');
    }

    public function index_get()
    {
    	$id_user = $this->get('id');

    	if( $id_user == NULL )
    	{
    		$arrUsers = $this->User->getItems();

    		if( !empty($arrUsers) )
    		{
    			$this->response($arrUsers, REST_Controller::HTTP_OK);
    		}
    		else
    		{
    			$this->response([
                    'status' => FALSE,
                    'message' => 'No User were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    		}
    	}
		
		$id_user = (int) $id_user;

		if ( $id_user <= 0 )
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $lang = $this->User->getItemById( $id_user );
        if (!empty($lang))
        {
            $this->set_response($lang, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    
}

?>