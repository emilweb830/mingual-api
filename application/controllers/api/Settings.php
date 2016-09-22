<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/controllers/api/Mingual_Controller.php';

class Settings extends Mingual_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
    	$id_user = parent::checkPermission();
		
		if ( $id_user <= 0 )
        {
            // Invalid id, set the response and exit.
            $this->response( NULL, REST_Controller::HTTP_OK, true); // BAD_REQUEST (400) being the HTTP response code
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
                'message' => $this->lang->line('empty_result')
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function index_put()
    {
        $id_user = parent::checkPermission();

        $settingData   = $this->put();
        if( empty($settingData) )
        {
            $this->response([
                'status'    => false,
                'message'   => $this->lang->line('empty_parameters')
            ], REST_Controller::HTTP_OK);
        }

        $setting = $this->Setting->getItems( "`id_user`='".$id_user."'", true );

        $settingData['id_user'] = $id_user;
        $settingData['id'] = $setting->id;

        if( isset( $settingData['sch_city']))
        {
            $address = $settingData['sch_city']; // Google HQ
            $prepAddr = str_replace(' ','+',$address);
            $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
            $output= json_decode($geocode);
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;

            $settingData['sch_g_lat'] = $latitude;
            $settingData['sch_g_lng'] = $longitude;
        }

        if( $this->Setting->updateItem( $settingData ))
        {
            $this->response([
                'status'    => true,
                'message'   => "Update Success."
            ], REST_Controller::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status'    => false,
                'message'   => "Update Error."
            ], REST_Controller::HTTP_OK);
        }
    }
    
}

?>