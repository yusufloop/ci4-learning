<?php

namespace App\Controllers;

use App\Models\Users;
use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        $users = new Users();
        
        //fetch all record
        $data['users'] = $users->findAll();

        return view('users', $data);
    }

    public function userDetails()
    {
        $request = service('request');
        $postData = $request->getPost();


        $data = array();

        // read new token and assign in $data['token'] 

        $data['token'] = csrf_hash();

        //validation
        $validation = \Config\Services::validation();

        $rules = $validation->setRules([
            'username' => 'required|min_length[3]'
        ]);

        if($validation->withRequest($this->request)->run() == FALSE)
        {
            $data['success'] = 0;
            $data['error'] = $validation->getError('username'); //error response
        }
        else
        {
            $data['success'] = 1;

            //fetch record

            $users = new Users();
            $user = $users->select('*')
                    ->where('username' , $postData['username'])
                    ->findAll();
            $data['users'] = $users;
        }

        return $this->response->setJSON($data);
    }
}
