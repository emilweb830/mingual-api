<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

use Facebook\Facebook as FB;
use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\FacebookBatchResponse;
use Facebook\Helpers\FacebookCanvasHelper;
use Facebook\Helpers\FacebookJavaScriptHelper;
use Facebook\Helpers\FacebookPageTabHelper;
use Facebook\Helpers\FacebookRedirectLoginHelper;

class Users extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('User');
        $this->load->model('Country');
        
        if( !strcmp( $this->uri->segment(3, 0), "login") )
            return;

        $headers = getallheaders();
        /*$token = isset( $headers['Token'])? $headers['Token'] : "";
        if( !$id_user = $this->User->check_login( $token ) && $token != "" )
        {
            $this->response([
                'status'    => false,
                'message'   => "Invalid Acccess."
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }*/
    }

    public function index_get()
    {
        $id_user = $this->get('id');

        if( $id_user == NULL )
        {
            $arrUsers = $this->User->getItems();

            if( !empty($arrUsers) )
            {
                foreach( $arrUsers as $v)
                    unset( $v->token );

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
            unset( $lang->token );
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
    
    public function login_get()
    {
        $access_token = $this->get('access_token');

        $this->fb = new FB([
            'app_id'                => $this->config->item('facebook_app_id'),
            'app_secret'            => $this->config->item('facebook_app_secret'),
            'default_graph_version' => $this->config->item('facebook_graph_version')
        ]);

        try {
          // Returns a `Facebook\FacebookResponse` object
          $response = $this->fb->get('/me?fields=id,name,email,gender,birthday,first_name,last_name,about,location,hometown,picture', $access_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        $user = $response->getGraphUser();

        $arrProfile = array(
                "facebook_id"   => $user['id'],
                "gender"        => substr($user->getGender(), 0, 1),
                "first_name"    => $user->getFirstName(),
                "last_name"     => $user->getLastName(),
                "date_add"      => date("Y-m-d h:i:s"),
                "date_modified" => date("Y-m-d h:i:s"),
                "latitude"      => "",
                "longitude"     => "",
                "age"           => 10,
                "teach_lang"    => 0,
                "learn_lang"    => 0,
                "about_me"      => "",
                "experience"    => "",
                "active"        => 1
            
            );

        $location = $user['location']['name'];
        list( $arrProfile['hometown'], $country ) = explode(", ", $location );
        
        $arrProfile['id_country'] = $this->Country->getItems("country_name='".$country."'", true)->id_country;
        $arrProfile['token']    = md5( $arrProfile['facebook_id'] . $arrProfile['first_name'] );
        
        $exists = $this->User->getItems( "facebook_id='".$arrProfile['facebook_id']."'", true );
        if( count( $exists ) > 0 ){
            
            $token  = md5( $arrProfile['facebook_id'] . $arrProfile['first_name'] );
            $this->User->updateItem( array( "id_user"=> $exists->id_user, "token"=> $token ) );
            
            $this->response([
                'status'    => TRUE,
                'id_user'   => $exists->id_user,
                'token'     => $token
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            //exit;
        }
        
        if( $id = $this->User->addItem( $arrProfile ))
        {
            $this->set_response([
                'status' => TRUE,
                'id_user'   => $id,
                'token' => $arrProfile['token']
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => "Login Error!"
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code

        }
    }
    
    public function logout_get()
    {
        $token = $this->get('token');
        if( !$id_user = $this->User->check_login( $token ) )
        {
            $this->response([
                'status'    => false,
                'message'   => "Unauthorized user."
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        if( $this->User->updateItem( array( "id_user"=> $id_user,"token"=> "" ) ) )
        {
            $this->response([
                'status'    => true,
                'message'   => "Logout success."
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        else
        {
            $this->response([
                'status'    => false,
                'message'   => "Logout Error."
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    
    // update user profile
    public function index_put()
    {
        $id_user    = $this->get('id');
        $userData   = $this->put();
        if( empty($userData) )
        {
            $this->response([
                'status'    => false,
                'message'   => "Empty Fields."
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        $userData['id_user'] = $id_user;
        if( $this->User->updateItem( $userData ))
        {
            $this->response([
                'status'    => true,
                'message'   => "Update Success."
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        else
        {
            $this->response([
                'status'    => false,
                'message'   => "Update Error."
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
//      foreach( $userData as $key => $value){
            
//      }
    }
}

?>