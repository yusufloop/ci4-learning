<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Controllers\BaseController;

class MemberController extends BaseController
{
    public function addMember()
	{
		helper(["url"]);

		if ($this->request->getMethod() == "post") {

			$memberModel = new MemberModel();

			$session = session(); // loading session service

			$data = [
				"name" => $this->request->getVar("name"),
				"email" => $this->request->getVar("email"),
				"mobile" => $this->request->getVar("mobile"),
			];

			if ($memberModel->save($data) === false) {

				return view('add-member', [
					'errors' => $memberModel->errors()
				]);
			} else {

				$session->setFlashdata("success", "Data saved successfully");

				return redirect()->to(base_url('add-member'));
			}
		}
		return view("add-member");
	}
}
