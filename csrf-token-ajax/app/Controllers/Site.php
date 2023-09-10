<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Site extends BaseController
{
    public function myForm()
    {
        return view('my-form');
    }

    public function submitData()
    {
        $data = $this->request->getVar();

        echo json_encode( array(
            "status" => 1,
            "message" => "Ajax procesed successfully",
            "data" => $data,
        ));
    }
}
