<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/controllers/api/Mingual_Controller.php';

use Facebook\Facebook as FB;
use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\FacebookBatchResponse;
use Facebook\Helpers\FacebookCanvasHelper;
use Facebook\Helpers\FacebookJavaScriptHelper;
use Facebook\Helpers\FacebookPageTabHelper;
use Facebook\Helpers\FacebookRedirectLoginHelper;

class Users extends Mingual_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->helper('url');
    }

    public function profile_get()
    {
        $id_user    = parent::checkPermission();
        if( $id_user == 0 )
        {
            $this->response([
                'status' => FALSE,
                'message' => 'No Registered'
            ], REST_Controller::HTTP_OK);
        }
        $user = $this->User->getFullProfileById( $id_user );
        $user->country->flag = base_url()."uploads/flag/".strtolower( $user->country->country_code ).".png";
        if( !empty($user) )
            $this->set_response( $user, REST_Controller::HTTP_OK ); // OK (200) being the HTTP response code
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'No Registered User'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function profile_put()
    {
        // TODO : photo update
        $id_user    = parent::checkPermission();
        $userData   = $this->put();
        if( empty($userData) )
        {
            $this->response([
                'status'    => false,
                'message'   => "Empty Fields."
            ], REST_Controller::HTTP_OK);
        }
        $userData['id_user'] = $id_user;

        if( isset($userData['photos']))
        {
            foreach( $userData['photos'] as $id_photo )
                $this->Photo->updateItem( array( "id_photo"=>$id_photo, "id_user"=>$id_user ) );

            unset( $userData['photos']);
        }

        if( $this->User->updateItem( $userData ))
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

    public function profile_delete()
    {
        $id_user    = parent::checkPermission();
        if( $this->User->updateItem( array( "id_user"=> $id_user,"token"=> "", "active" => 0 ) ) )
        {
            $this->response([
                'status'    => true,
                'message'   => "Account is deleted."
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'status'    => false,
                'message'   => "Error"
            ], REST_Controller::HTTP_OK);
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
            $this->response([
                'status' => FALSE,
                'message' => 'Graph returned an error: ' . $e->getMessage()
            ], REST_Controller::HTTP_OK); 
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            $this->response([
                'status' => FALSE,
                'message' => 'Facebook SDK returned an error: ' . $e->getMessage()
            ], REST_Controller::HTTP_OK); 
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
            $this->Setting->createDefaultSetting( $exists->id_user );
            $this->response([
                'status'    => TRUE,
                'user'   => $this->User->getFullProfileById($exists->id_user),
                'token'     => $token
            ], REST_Controller::HTTP_OK); 
        }
        
        if( $id = $this->User->addItem( $arrProfile ))
        {
            $this->Setting->createDefaultSetting( $id );
            $this->set_response([
                'status' => TRUE,
                'user'   => $this->User->getFullProfileById($id),
                'token' => $arrProfile['token']
            ], REST_Controller::HTTP_OK); 
            
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => "Login Error!"
            ], REST_Controller::HTTP_OK); 

        }
    }
    
    public function logout_get()
    {
        $id_user = parent::checkPermission();
        
        if( $this->User->updateItem( array( "id_user"=> $id_user,"token"=> "" ) ) )
        {
            $this->response([
                'status'    => true,
                'message'   => "Logout success."
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'status'    => false,
                'message'   => "Logout Error."
            ], REST_Controller::HTTP_OK);
        }
    }

    public function report_put()
    {
        $id_user = parent::checkPermission();
        $input = $this->put();

        if( !isset($input['report_type']) || !isset($input['comment']) )
        {
            $this->response([
                'status'    => false,
                'message'   => $this->lang->line("message_invalid_params")
            ], REST_Controller::HTTP_OK);
        }
        $arrReport = array(
                "id_user"       => $id_user,
                "report_type"   => $input['report_type'],
                "comment"       => $input['comment'],
                "date_add"      => date("Y-m-d h:i:s")
            );

        if( $this->Report->addItem( $arrReport ) )
        {
            $this->response([
                'status'    => true,
                'message'   => "Success."
            ], REST_Controller::HTTP_OK);

        }
        else
        {
             $this->response([
                'status'    => false,
                'message'   => "Failed."
            ], REST_Controller::HTTP_OK);
        }
    }

    public function contactus_post()
    {
        $id_user = parent::checkPermission();
        $input = $this->post();

        if( !isset($input['comment']) )
        {
            $this->response([
                'status'    => false,
                'message'   => $this->lang->line("message_invalid_params")
            ], REST_Controller::HTTP_OK);
        }

        $message = "Contact Us test";

        if( mail( $this->config->item('support_email'), "Contact us", $message ) )
        {
            $this->response([
                'status'    => true,
                'message'   => "Message sent."
            ], REST_Controller::HTTP_OK);

        }
        else
        {
             $this->response([
                'status'    => false,
                'message'   => "Failed."
            ], REST_Controller::HTTP_OK);
        }
    }

    public function search_get()
    {
        // check permission and get authenticated user ID
        $id_user = parent::checkPermission();

        // load search setting 
        $setting = $this->Setting->getItems("`id_user`=".$id_user, true );

        // parse search params
        $offset = $this->get('offset');
        if( $offset == NULL )
            $offset = 0;
        $users = $this->User->searchUserBySetting( $id_user, $setting, $offset );

        if( empty( $users ) || count( $users ) < 1 )
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
                'count'     => $users['count'],
                'offset'    => $users['offset'],
                'users'      => $users['data']
            ], REST_Controller::HTTP_OK);

        }
    }

    public function index_get()
    {
        $id_user = $this->get('id');

        if( $id_user == NULL )
        {
            $arrUsers = $this->User->getItems();

            if( !empty($arrUsers) )
            {
                foreach( $arrUsers as &$v){
                    $v = $this->User->getFullProfileById( $id_user );
                    //$v->country->flag = base_url()."uploads/flag/".strtolower( $v->country->country_code ).".png";

                    unset( $v->token );
                }

                $this->response($arrUsers, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No User were found'
                ], REST_Controller::HTTP_OK);
            }
        }
        
        $id_user = (int) $id_user;

        if ( $id_user <= 0 )
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_OK); 
        }

        //$lang = $this->User->getItemById( $id_user );
        $user = $this->User->getFullProfileById( $id_user );
        if (!empty($user))
        {
            $user->country->flag = base_url()."uploads/flag/".strtolower( $user->country->country_code ).".png";
            unset( $user->token );
            $this->set_response(array("status"=>TRUE,"info"=>$user), REST_Controller::HTTP_OK);
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_OK); 
        }
    }

    public function photo_post()
    {
        $id_user = parent::checkPermission();

        $config['upload_path'] = 'uploads/photos/';
        $path=$config['upload_path'];
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '1920';
        $config['max_height'] = '1280';
        $this->load->library('upload', $config);

        if( empty( $_FILES ) )
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Empty Files'
            ], REST_Controller::HTTP_OK);
        }
        $photo_ids = array();
        foreach ($_FILES as $fieldname => &$fileObject)  //fieldname is the form field name
        {
            if (!empty($fileObject['name']))
            {
                $fileObject['name'] = time()."_".$fileObject['name'];
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($fieldname))
                {
                    $this->response(array("status"=>"error", "message" => strip_tags($this->upload->display_errors())), 200);
                }
                else
                {
                    $upload = $this->upload->data();
                    $file_url = base_url()."uploads/photos/".$upload['file_name'];
                    $photo_ids[] = $this->Photo->addItem(array("id_user"=>0, "url"=> $file_url, "date_add"=>date("Y-m-d h:i:s")));
                }
            }
        }
        if( empty( $photo_ids ) )
        {
            $this->response([
                'status' => FALSE,
                'message' => 'Uploading Error'
            ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->response([
                'status' => TRUE,
                'photo_ids' => $photo_ids
            ], REST_Controller::HTTP_OK);            
        }
    }

}

?>