<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MemberModel;

class MemberController extends BaseController
{
    public function index()
    {
        helper(['url']);

        if($this->request->getMethod() == "post")
        {
            $member = new MemberModel();

            $rules = [
                "name" => "required|min_length[3]|max_length[255]",
                "email" => "required|valid_email",
                "mobile" => "required",
            ];

            $messages = [
                "name" => [
                    "required" => "Name is required",
                    "max_length" => "Maximum length of Name is 255 chars",
                ],
                "email" => [
                    "required" => "Email is required",
                ],
                "mobile" => [
                    "required" => "Mobile Number is required",
                ],
            ];
            $session = session(); // loading session service

            if(!$this->validate($rules, $messages))
            {
                return view("add-member", [
                    "validation" => $this->validator,
                ]);
            }
            else
            {
                $data = [
                    "name" => $this->request->getVar("name"),
                    "email" => $this->request->getVar("email"),
                    "mobile" => $this->request->getVar("mobile"),
                ];

                if($member->insert($data))
                {
                    $session->setFlashdata("success", "Data has successfully been inserted");
                }
                else
                {
                    $session->setFlashdata("error", "Failed to save data!");
                }
                return redirect()->to('add-member');
            }
        }
        return view("add-member");
    }
}
