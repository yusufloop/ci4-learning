<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        return view('users');
    }

    public function fileUpload()
    {
        $rules =$this->validate([
            'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpg,jpeg,png,docx,pdf],'
        ]);
        
        if(!$rules) //not valid
        {
            $data['validation'] = $this->validator;
            return view('users', $data);
        }
        else //valid
        {
            if($file = $this->request->getFile('file'))
            {
                if($file->isValid() && !$file ->hasMoved())
                {
                    //get file name and extension
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    //getRandom file name
                    $newName = $file->getRandomName();

                    //store file in public/upload/folder
                    $file->move('../public/uploads',$newName);

                    //file path to display preview
                    $filepath = base_url()."/uploads/".$newName;

                    //set session
                    session()->setFlashdata('message', 'Uploaded Success!');
                    session()->setFlashData('alert-class', 'alert-success');
                    session()->setFlashdata('filepath', $filepath);
                    session()->setFlashData('extension', $ext);
                }
                else
                {
                    // set session 
                    session()->setFlashdata('message', 'File Not Uploaded');
                    session()->setFlashData('alert-class', 'alert-danger');
                }
            }
        }
        return redirect()->route('/');
    }
}
