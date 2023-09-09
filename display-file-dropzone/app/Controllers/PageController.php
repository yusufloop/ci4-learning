<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PageController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function readFiles()
    {
        $file_list = array();

        $validextension_arr = array('jpeg','jpg','png','pdf');

        //target location

        $target_dir = "uploads/";
        $dir = $target_dir;

        if(is_dir($dir))
        {
            if($dh = opendir($dir))
            {
                //readfiles
                while(($file = readdir($dh)) !== false)
                {
                    if($file != '' && $file != '.' && $file != '..')
                    {
                        //file path
                        $file_path = $target_dir.$file;

                        //check if file is folder or not
                        if(!is_dir($file_path))
                        {
                            $size = filesize($file_path);
                            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                            if(in_array($extension, $validextension_arr))
                            {
                                $file_list[] = array('name' => $file, 'size' => $size, 'path' => $file_path);
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
        return $this->response->setJSON($file_list);
    }

    //upload files
    public function fileUpload()
    {
        $data = array();

        // READ NEW TOKEN AND ASSIGN TO $DATA['TOKEN ']
        $data['token'] = csrf_hash();

        //validation
        $validation = \Config\Services::validation();

        $rules = $validation->setRules([
            'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,jpeg,jpg,png,pdf],'
        ]);

        if($validation->withRequest($this->request)->run() == FALSE)
        {
            $data['success'] = 0;
            $data['error'] = $validation->getError('file');

        }
        else
        {
            if($file = $this->request->getFile('file'))
            {
                if($file->isValid() && ! $file->hasMoved())
                {
                    // get file name and extension 
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    // get random file name 
                    $newName = $file->getRandomName();

                    //store file in public/uploads/folder
                    $file->move('../public/uploads', $newName);

                    //response
                    $data['success'] = 1;
                    $data['message'] ='Uploaded Successfully!';

                }
                else
                {
                    //response
                    $data['success'] = 2;
                    $data['message'] ='File not uploaded!';
                }
            }
            else
            {
                //response
                $data['success'] = 2;
                $data['message'] ='File not uploaded!';
            }
        }
        return $this->response->setJSON($data);
    }
}
