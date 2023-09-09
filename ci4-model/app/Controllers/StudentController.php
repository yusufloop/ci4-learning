<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;

class StudentController extends BaseController
{
    public function insertData()
    {
        $object  = new StudentModel();

        $object->insert([
            "name" => "yusuf ibrahim",
            "email" => "yusuf@gmail.com",
            "mobile" => "0123456789",
        ]);

        $object->insertBatch([
            [
                "name" => "yusuf ibrahim",
                "email" => "yusuf@gmail.com",
                "mobile" => "0123456789",
            ],
            ["name" => "azri ibrahim",
                "email" => "yusuf@gmail.com",
                "mobile" => "0123456789",
            ]
        ]);

        
    }
    public function updateData()
    {
        $object =new StudentModel();

        $object->set([
            "name" => "yusuf ibrahim",
            "email" => "test@gmail.com",
            "mobile" => "0123456789",
        ]);
        //where condition
        $object->where([
            "id" =>2
        ]);

        //calling update( method
        $object->update();

        // OR
		// $$object->where([$condition])->set([$data])->update()
    }

    public function deleteData()
    {
        $object = new StudentModel();

        $object->where([
            "id" => 2
        ]);

        //calling delete() method
        $object->delete();

        //or
        // $object->where([$id])->delete();
    }

    public function selectData()
    {
        $object = new StudentModel();

        //get all rows
        $all_student = $object->findAll();
        dd($all_student);
        //get a single rows
        $student = $object->find(3);
        dd($student);
    }
}
