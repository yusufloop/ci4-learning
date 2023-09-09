<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Student extends BaseController
{
    public function index()
    {
        if($this->request->getMethod() == "post")
        {
            $rules = [
                "name" => "required",
                "email" => "required|valid_email|is_unique[users.email]|min_length[6]",
                "mobile" => "required",
            ];

            $messages = [
                "name" =>[
                    "required" => "Name is required"
                ],
                "email" => [
                    "required" => "Email is required",
                    "valid_email" => "Email is not valid",
                    "is_unique" => "Email is already taken",
                    "min_length" => "Email must be at least 6 characters long"
                ],
                "mobile" => [
                    "required" => "Mobile is required"
                ],
            ];
            if(!$this->validate($rules, $messages))
            {
                return view("add-student",[
                    "validation" => $this->validator,
                ]);
            }
            else
            {
                //sent data to database
                
            }
            return view("add-student");    
            
        }
    }
}
