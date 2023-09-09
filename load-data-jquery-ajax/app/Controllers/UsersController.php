<?php

namespace App\Controllers;

use App\Models\Users;
use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function getUsers()
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // READ NEW TOKEN AND ASSIGN IN $response['token'] 
        $response['token'] = csrf_hash();

        if(!isset($postData['searchTerm']))
        {
            //fetch record
            $users= new Users();
            $userList = $users->select('id,name')
                        ->orderBy('name')
                        ->findAll(5);
        }
        else
        {
            $searchTerm = $postData['searchTerm'];

            //fetch record
            $users = new Users();
            $userList = $users->select('id,name')
                        ->like('name', $searchTerm)
                        ->orderBy('name')
                        ->findAll(5);
        }
        $data = array();
        foreach($userList as $user)
        {
            $data[] = array(
                "id" => $user['id'],
                "text" => $user['name'],
            );
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);
    }
}
