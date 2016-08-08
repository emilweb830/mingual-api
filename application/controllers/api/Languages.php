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

    function languages_get()
    {
    	$id_lang = $this->get('id');

    	if( $id_lang == NULL )
    	{
    		$arrLang = $this->Lang->getItems();

    		if( !empty($arrLang) )
    		{
    			$this->response($arrLang, REST_Controller::HTTP_OK);
    		}
    		else
    		{
    			$this->response([
                    'status' => FALSE,
                    'message' => 'No languages were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    		}
    	}
		
		$id_lang = (int) $id_lang;

		if ( $id_lang <= 0 )
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $lang = $this->Lang->getItemById( $id_lang );
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

    function languages_put()
    {

    }
}
?>