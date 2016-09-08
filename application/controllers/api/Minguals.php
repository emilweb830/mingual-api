<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/controllers/api/Mingual_Controller.php';

class Minguals extends Mingual_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();        
        $this->load->helper('url');
    }

    public function connect_put()
    {
    	$id_user = parent::checkPermission();
    	$partner_id = $this->put( 'partner_id' );
    	
    	if( !$partner_id )
        {
            $this->response([
                'status'    => false,
                'message'   => $this->lang->line("message_invalid_params")
            ], REST_Controller::HTTP_OK);
        }

        $return = $this->Mingual->makeMingual( $id_user, $partner_id );
    	if( $return['status'] )
            $this->response([
                'status'    => TRUE,
                'mingual_status'   => $return['mingual']->mingual_status1 && $return['mingual']->mingual_status2
            ], REST_Controller::HTTP_OK);
        else
            $this->response([
                'status'    => FALSE,
                'message'   => $return['message']
            ], REST_Controller::HTTP_OK);
    }

    public function partners_get()
    {
    	$id_user = parent::checkPermission();

        $offset = $this->get('offset');
        if( $offset == NULL )
            $offset = 0;

    	$partners = $this->Mingual->getPartnerList( $id_user, $offset );

        if( empty( $partners ) || count( $partners ) < 1 )
        {
            $this->response([
                'status'    => true,
                'message'   => "No Matched User."
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'status'    => true,
                'count'     => $partners['count'],
                'offset'    => $partners['offset'],
                'partners'  => $partners['data']
            ], REST_Controller::HTTP_OK);
        }
    }

    public function unmatch_put()
    {
		$id_user = parent::checkPermission();
    	$partner_id = $this->put( 'partner_id' );
    	
    	if( !$partner_id )
        {
            $this->response([
                'status'    => false,
                'message'   => $this->lang->line("message_invalid_params")
            ], REST_Controller::HTTP_OK);
        }

        $status = $this->Mingual->unmatch( $id_user, $partner_id );
    	if( $status )
        	$message = "Congurats";
        else
        	$message = "Error";

        $this->response([
            'status'    => $status,
            'message'   => $message
        ], REST_Controller::HTTP_OK);    
   	}
}
?>