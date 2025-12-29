<?php error_reporting(0);
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require (APPPATH.'/libraries/REST_Controller.php');
require (APPPATH."/libraries/Format.php");
use Restserver\Libraries\REST_Controller;

class AutoApi extends REST_Controller {
    public function __construct() { 
        parent::__construct();
        
        //load user model
        $this->load->model('api');
    }
    public function user_get($id = 0) {
        //returns all rows if the id parameter doesn't exist,
        //otherwise single row will be returned
        $users = $this->api->getRows($id);
        
        //check if the user data exists
        if(!empty($users)){
            //set the response and exit
            $this->response($users, REST_Controller::HTTP_OK);
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function getMakes_get($id = 0) {
        $data = $this->api->getMakes($id);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function getmodel_get($id = 0) {
        $data = $this->api->getmodel($id);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function getyears_get($id = 0) {
        $data = $this->api->getyears($id);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function get_vehicle_products_get($id = 0) {
        $data = $this->api->get_vehicle_products($id);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function returns_post($query){
        $data = $this->api->returns_add();
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function return_items_post($query){
        $data = $this->api->return_items_add();
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function return_items_get($id){
        $data = $this->api->return_items_get($id);
        if(!empty($data)){
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'No user were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
}
