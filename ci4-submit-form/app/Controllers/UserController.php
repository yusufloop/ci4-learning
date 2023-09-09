<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    public function __contruct()
    {
        helper(["url"]);
    }

    public function addUser()
    {
            //layout of add user form
            return view('add-user');
    }

    public function saveUser()
    {
        if($this->request->getMethod() == "post")
        {
            $rules = [
                "name" => "required",
                "email" => "required|valid_email",
                "mobile" => "required|numeric",
            ];

            if( !$this->validate($rules))
            {
                $response = [
                    'success' => false,
                    'msg' => "There are some validation errors",
                ];

                return $this->response->setJSON($response);
            }
            else
            {
                $user = new User;

                $data = [
                    "name" => $this->request->getVar("name"),
                    "email" => $this->request->getVar("email"),
                    "mobile" => $this->request->getVar("mobile"),
                ];

                if($user->insert($data))
                {
                    $response = [
                        'success' => true,
                        'msg' => "User added successfully",
                    ];
                }
                else
                {
                    $response = [
                        'success' => false,
                        'msg' => "Failed to add user",
                    ];
                }

                return $this->response->setJSON($response);
            }
        }
    }
}
