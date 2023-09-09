<?php

namespace App\Controllers;


use App\Models\MemberModel;
use App\Controllers\BaseController;

class Member extends BaseController
{
    public function addMember()
    {
        if($this->request->getMethod() == "post")
        {
            $rules = [
                "name" => "required|min_length[3]|max_length[40]",
                "email" => "required|valid_email",
                "mobile" => "required|min_length[9]|max_length[15]",
            ];

            if(!$this->validate($rules))
            {

                return view('add-member', [
                    "validation" => $this->validator,
                ]);
            }
            else
            {
                $member = new MemberModel();

                $data = [
                    'name' => $this->request->getVar("name"),
                    'email' => $this->request->getVar("email"),
                    'mobile' => $this->request->getVar("mobile"),
                ];

                $member->save($data);

                $session = session();
                $session->setFlashdata("success", "Members added succesfully!");
                return redirect()->to(base_url('list-members'));
            }
        }

        return view('add-member');
    }

    public function listMember()
    {
       $member = new MemberModel();
       
       $members = $member->findAll();

       return view('list-members', [
            "members" => $members,
       ]);
    }

    public function editMember($id = null)
    {
        $member = new MemberModel();

        $members = $member->where("id", $id)->first();

        if($this->request->getMethod() == "post")
        {
            $rules = [
                "name" => "required|min_length[3]|max_length[40]",
                "email" => "required|valid_email",
                "mobile" => "required|min_length[9]|max_length[15]",
            ];
        
        if(!$this->validate($rules))
        {
            return view('edit-member', [
                "validation" => $this->validator,
                "member" => $members,
            ]);
        }
        else
        {
            $data = [
                'name' => $this->request->getVar("name"),
                'email' => $this->request->getVar("email"),
                'mobile' => $this->request->getVar("mobile"),
            ];

            $member->update($id, $data);

            session()->setFlashdata("success", "Member updated succesfully!");
            return redirect()->to(base_url('list-members'));
        }
    }

    return view('edit-member',[
        "member" => $members,
    ]);

    }

    public function deleteMember($id = null)
    {
        $member = new MemberModel();
        $members = $member->delete($id);

        $session = session();
        $session->setFlashdata("success", "member deleted successfully!");

        return redirect()->to(base_url('list-members'));
    }
}

    

