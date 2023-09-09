<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class UsersController extends BaseController
{
	
	public function index(){
	    
      $users = new Users();

      ## Fetch all records
      $data['users'] = $users->findAll();
        
      return view('index',$data);
    }

    public function userDetails(){

      $request = service('request');
      $postData = $request->getPost();

      $data = array();

      // Read new token and assign in $data['token']
      $data['token'] = csrf_hash();

      ## Validation
      $validation = \Config\Services::validation();

      $input = $validation->setRules([
        'username' => 'required|min_length[3]'
      ]);

      if ($validation->withRequest($this->request)->run() == FALSE){

         $data['success'] = 0;
         $data['error'] = $validation->getError('username');// Error response

      }else{

         $data['success'] = 1;
         
         // Fetch record
         $users = new Users();
         $user = $users->select('*')
                ->where('username',$postData['username'])
                ->findAll();

         $data['user'] = $user;

      }

      return $this->response->setJSON($data);

    }
}
