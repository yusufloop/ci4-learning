<?php

namespace App\Controllers;

use App\Models\Users;
use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        // fetch all data 
        $users = new Users();
        $data['users'] = $users->findAll();
        
        return view('users/index', $data);
    }

    // file upload and insert records 
    public function importFile()
    {
        //validation
        $rules = $this->validate([
            'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,xlsx,csv],'
        ]);

        if(!$rules) //not valid
        {
            $data['validation'] = $this->validator;

            return view('users/index', $data);
        }
        else //valid
        {
            if($file = $this->request->getFile('file'))
            {
                if($file->isValid() && ! $file->hasMoved())
                {
                    // getRandom file name 
                    $newName =$file->getRandomName();

                    // Store file in public/csvfile/folder
                    $file->move('../public/csvfile', $newName);

                    // Reading file 
                    $file = fopen("../public/csvfile/".$newName,"r");
                    $i = 0;
                    $numberOfFields = 4; //total number of field

                    $importData_arr = array();

                    // initialize $importData_arr Array \
                    while(($filedata = fgetcsv($file, 1000, "," )) !== FALSE)
                    {
                        $num = count($filedata);

                        //Skip First row and check number of field
                        if($i > 0 && $num == $numberOfFields)
                        {
                            // Key names are the insert table field names - name, email, city, and status

                            $importData_arr[$i]['name'] = $filedata['0'];
                            $importData_arr[$i]['email'] = $filedata['1'];
                            $importData_arr[$i]['city'] = $filedata['2'];
                            $importData_arr[$i]['status'] = $filedata['3'];
                        }

                        $i++;
                    }

                    fclose($file);

                    //Insert Data
                    $count = 0;
                    foreach($importData_arr as $userdata)
                    {
                        $users = new Users();

                        //Check all record\
                        $checkrecord = $users->where('email', $userdata['email'])->countAllResults();

                        if($checkrecord == 0)
                        {
                            // insert record 
                            if($users->insert($userdata))
                            {
                                $count++;
                            }
                        }
                    }

                    //set session
                    session()->setFlashdata('message',$count. 'Record inserted successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                }
                else
                {
                    //set session
                    session()->setFlashdata('message','File not imported.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            }
            else
            {
                //set session
                session()->setFlashdata('message', 'File not imported.');
                session()->setFlashdata('alert-class', 'alert-danger');
            }
        }
        return redirect()->route('/');
    }
}

 