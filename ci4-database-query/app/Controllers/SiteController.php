<?php

namespace App\Controllers;

use App\Models\StudentModel;
use Config\Database;
use App\Controllers\BaseController;

class SiteController extends BaseController
{

    // raw query
    // -----------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->db = Database::connect();

        //or 

        // $this->db = db_connect();
    }

    public function insertRaw()
    {
        $query = "Insert into 
        users(name, email, phone_no) 
        values('Yusuf', 'yusuf@gmail.com', '08123456789')";

        if($this->db->query($query))
        {
            echo "<h3>Record Inserted Successfully</h3>";
        }
        else
        {
            echo "<h3>Failed to Insert Record</h3>";
        }
    }

    public function updateRawQuery()
    {
        $query = "Update users 
        SET name = 'Anas' wmail = 'online@gmail.com', phone_no = '0134252522' 
        WHERE id = 2";

        if($this->db->query($query))
        {
            echo "<h3>Record Updated Successfully</h3>";
        }
        else
        {
            echo "<h3>Failed to Update Record</h3>";
        }
    }

    // delete query 
    public function deleteRawQuery()
    {
        $query = "Delete from users 
        where id = 2";

        if($this->db->query($query))
        {
            echo "<h3>Record Deleted Successfully</h3>";
        }
        else
        {
            echo "<h3>Failed to Delete Record</h3>";
        }
    }

    public function getData()
    {
        // $data = $this->db->query("SELECT* from users")->getResult();
        // find data in object format 

        // $data = $this->db->query("SELECT * from users")->getResult('array');
        // // find data in array format

        // $data = $this->db->query("SELECT * from users")->getResultArray();
        // // find data in array format 

        // $data = $this->db->query("SELECT * from users WHERE id = 3")->getRow();
        // // find data row in object format

        $data = $this->db->query("SELECT * from users WHERE id = 3")->getRowArray();
        // find data row in array format

        return $data;
    }

    // query builder 
    // ---------------------------------------------------------------------------------------------------------


    public function insertData()
    {
        $builder  = $this->db->table("users");

        $data = [
            "name" => "user 1",
            "email" => "user1@gmail.com",
            "phone_no" => "0123456789",
        ];

        // $data = [
        //     array(
        //       "name" => "Data 1",
        //       "email" => "data1@gmail.com",
        //       "phone_no" => "555555555",
        //     ),
        //     array(
        //       "name" => "Data 2",
        //       "email" => "data2@gmail.com",
        //       "phone_no" => "66666666666",
        //     ),
        //   ];
        // $return_data = $builder->insertBatch($data);

        return $builder->insert($data);
    }

    public function updateData()
    {
        $builder = $this->db->table("users");

        $updatedData = [
            "name" => "Data",
            "email" => "updated-data@dummy.com",
            "phone_no" => "8888888",
        ];

        $builder->where([
            "id" => 8
        ]);

        $builder->set($updatedData);

        return $builder->update();

    }

    //update query using chaining method;
    public function updateDataChain()
    {
        $builder = $this->db->table("users");

        $updatedData = [
            "name" => "Data",
            "email" => "updated-data@dummy.com",
            "phone_no" => "8888888",
        ];

        return $builder->where([
            "id" => 8
        ])->set($updatedData)->update();
    }

    // Delete query 
    public function deleteData()
    {
        $builder = $this->db->table("users");

        $id = 9;

        $builder->where([
            "id" => $id,
        ]);

        return $builder->delete();
    }

    public function getData()
    {
        $builder =  $this->db->table("users");

         // lets add where condition
        //$builder = $builder->where("id", 4);
        //$builder = $builder->where("email", "online@gmail.com");

        // or

        $builder = $builder->where([
            "id" => 4,
            "email" => "online@gmail.com",
        ]);

        //select all data
        $data = $builder->get()->getRow();
        //or
        // echo $this->db->getLastQuery();
        //or
        // $data= $this->db->query->query("SELECT * from users");
        //or
        // $data = $this->db->table("users")->get()->getResult();

        // All data format methods 
        // getRow(), 
        // getRowArray(), 
        // getResult(), 
        // getResultArray() 
        // we can use it here.

        return $data;

    }

    // --------------------------------------------------------------------------------------------------

    public function insertDataModel()
    {
        $userModel = new StudentModel();

        /*$data = array(
            "name" => "TTT2",
            "email" => "ttt2@gmail.com",
            "phone_no" => "53454354545",
        );*/

        //insert batch method call
        // $return_data = $userModel->insert($data);

        $data = [
            array(
              "name" => "TTT2",
              "email" => "ttt2@gmail.com",
              "phone_no" => "53454354545",
            ),
            array(
              "name" => "TTT3",
              "email" => "ttt3@gmail.com",
              "phone_no" => "7665353453",
            ),
          ];

          //insert batch method call
          $return_data = $userModel->insertBatch($data);

           echo $return_data;
    }

    public function updateDataModel($update_id = 0)
    {
        $userModel = new StudentModel();

        $data = [
            "name" => "Data",
            "email" => "updated-data@dummy.com",
            "phone_no" => "8888888",
          ];
          return $userModel->where([
            "id" => $update_id,
          ])->set($data)-> update();
    }

    public function deleteDataModel($id = 0)
    {
        $userModel = new StudentModel();

        return $userModel->where([
            "id" => $id,
        ])->delete();
    }
    public function index()
    {
        //
    }
}
