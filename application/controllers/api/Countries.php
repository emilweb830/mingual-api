<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Countries extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Country');
        $this->load->helper('url');
    }

    function index_get()
    {
        $id_country = $this->get('id');

        if( $id_country == NULL )
        {
            $arrCountries = $this->Country->getItems();

            if( !empty($arrCountries) )
            {
                foreach( $arrCountries as &$country )
                    $country->flag = $this->Country->getFlagUrl( $country->country_code );
                $this->response($arrCountries, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No country were found'
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }
        
        $id_country = (int) $id_country;

        if ( $id_country <= 0 )
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_OK); // BAD_REQUEST (400) being the HTTP response code
        }

        $country = $this->Country->getItemById( $id_country );
        if (!empty($country))
        {
            $country->flag = $this->Country->getFlagUrl( $country->country_code ); //base_url()."uploads/flag/".strtolower( $country->country_code ).".png";
            $this->set_response($country, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Country could not be found'
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }
    }

}
?>