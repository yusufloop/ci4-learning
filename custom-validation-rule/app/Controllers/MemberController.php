<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MemberController extends BaseController
{
    public function addMember()
    {
        helper(["url"]);

        if($this->request->getMethod() == "post")
        {
            $rules = [
                "name" => "required|valid_name", //custom rule
                "email" => "required|valid_email",
                "mobile" => "required|checkMobile", //custom rule
            ];

            if(!$this->validate($rules))
            {
                return view("add-member",[
                    "validation" => $this->validator,
                ]);
            }
            else
            {
                $data =[
                    "name" => $this->request->getVar("name"),
                    "email" => $this->request->getVar("email"),
                    "mobile" => $this->request->getVar("mobile"), 
                ];
                return redirect()->to('add-member');
            }
        }
        return view("add-member");
    }
}
