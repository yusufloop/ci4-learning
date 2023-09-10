<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        if($this->request->getMethod() == "post")
        {
            $rules =[
                "name" => "required|min_length[3]|max_length[20]",
                "email" => "required|valid_email",
                "phone_no" => "required|numeric|min_length[3]|max_length[10]",
                "profile_image" => [
                    "rules" => "uploaded[profile_image]|max_size[profile_image,1024]|is_image[profile_image]|mime_in[profile_image,image/png,image/jpg,image/jpeg]",
                    "label" => "Profile Image"
                ],
            ];

            if(!$this->validate($rules))
            {
                return view("my-form",[
                    "validation" => $this->validator,
                ]);
            }
            else
            {
            $file = $this->request->getFile("profile_image");
            $file_type = $file->getClientMimeType();
            $valid_file_types = [
                "image/png",
                "image/jpg",
                "image/jpeg",
            ];
            $session = session();

            if(in_array($file_type, $valid_file_types))
            {
                $profile_image = $file->getName();

                // We can also use it like this. Automatically move function place the default image name into specified location.
                // Second value will be more beneficiary when we want to give a different name to the uploaded file.
                // $file->move("images"); 

                if($file->move("images", $profile_image))
                {
                    $user = new UserModel();

                    $data = [
                        "name" => $this->request->getVar("name"),
                        "email" => $this->request->getVar("email"),
                        "phone_no" => $this->request->getVar("phone_no"),
                        "profile_image" => "/images/" . $profile_image,
                    ];

                    if($user->insert($data))
                    {
                        $session->setFlashdata("success", "data has been successfully inserted");
                    }
                    else
                    {
                        $session->setFlashdata("error", "data has not been  inserted");
                    }
                }
                else
                {
                    $session->setFlashdata("error", "file has not been moved");
                }
            }
            else
            {
                //invalid type files
                $session->setFlashdata("error", "file type is not valid");
            }
        }
        
            return redirect()->to(base_url());
        }

        return view("my-form");
    }
}
