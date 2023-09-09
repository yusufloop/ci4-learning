<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function fileUpload()
    {
        $data = array();

        //read new token and assign to $data['token']
        $data['token'] = csrf_hash();

        ##validation 
        $validation = \Config\Services::validation();

        $rules =$validation->setRules([
            'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,png,jpeg,jpg,docx,pdf],' 
        ]);

        if($validation->withRequest($this->request)->run() == FALSE)
        {
            $data['success'] = 0;
            $data['error'] = $validation->getError('file'); //error response
        }
        else
        {
            if($file = $this->request->getFile('file'))
            {
                if($file->isValid() && ! $file->hasMoved())
                {
                    // GEt filename and extension
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    //get random file name
                    $newName = $file->getRandomName();

                    //store file in public /uploads/folder
                    $file->move('../public/uploads', $newName);

                    //file path in to dispolay preview
                    $filepath = base_url(). "/uploads/". $newName;

                    //response
                    $data['success'] = 1;
                    $data['message'] = 'Uploaded Successfully!';
                    $data['filepath'] = $filepath;
                    $data['extension'] = $ext;
                }
                else
                {
                    //response
                    $data['success'] = 2;
                    $data['message'] = 'File Not Uploaded';
                }
            }
            else
            {
                //response
                $data['success'] = 2;
                $data['message'] = 'File Not Uploaded';
            }
        }
        return $this->response->setJSON($data);
    }
}
