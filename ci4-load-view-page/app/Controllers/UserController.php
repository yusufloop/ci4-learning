<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $data['content'] = "Home Page";
        return view('user_view', $data);
    }
}
