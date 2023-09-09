<?php

namespace App\Controllers;


use App\Entities\UserEntity;
use App\Models\UserModel;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        // ....

        // default provided insert(), save(), update() & delete()
    }
    // ------------------------------------------------------------------------------------------------------------------------
    //create custom methods at Model to handle all database operations like for add, update, delete
    protected $table = 'users';
    private $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        // OR 
        // $this->db = db_connect();
    }

    public function insertData($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function updateData($id, $data = array())
    {
        $this->db->table($this->table)->update($data, array(
            "id" => $id,
        ));
        return $this->db-> affectedRows();
    }

    public function deleteData($id)
    {
        return $this->db->table($this->table)->delete(array(
            "id" => $id,
        ));
    }
    public function getAllData()
    {
        $query = $this->db->query("SELECT * FROM $this->table");
        return $query->getResult();
    }


    // ------------------------------------------------------------------------------------------------------------------------
    //call inbuilt methods in model from controller
    public function indexInbuiltMethods()
    {
        $userModel = new UserModel();

        // Add operation
        $userModel->insert_data(array(
            "name" => "Sanjay",
            "email" => "sanjay@gmail.com",
            "phone_no" => "1234567890",
        ));

        // Update Operation
        $userModel->update_data(1, array(
            "name" => "Sanjay",
            "email" => "sanjay@gmail.com",
            "phone_no" => "1234567890",
        ));

        //...
    }

    // ------------------------------------------------------------------------------------------------------------------------
    // Insert/Select Data Using Model & Entity

    public function insertDataUsingModelEntity()
    {

        #first method of insert data

        // Creating an instance of modal
        $userModel = new UserModel();

        // Creating an instance of entity
        $user = new UserEntity();

        $data = [
            "name" => "Sanjay",
            "email" => "sanjay@gmail.com",
            "phone_no" => "1234567890",
        ];
        $user->fill($data);

        $userModel->save($user);

        #second method of insert data
        // Creating an instance of modal
        $userModel = new UserModel();

        // Creating an instance of entity
        $user = new UserEntity();

        $user->name = "User 101";
        $user->email = "user101@gmail.com";
        $user->phone_no = "1234567890";

        $userModel->save($user);
    }

    public function selectDataUsingModelEntity()
    {
        $userModel = new UserModel();

        $users = $userModel->findAll();

        // this will return all data into User Entity object, 
        // because we have configured Entity in returnType in model class
    }

    public function insertDataUsingModelEntityUsingMapping()
    {
        $userModel = new UserModel();

        $user = new UserEntity();

        $user->fullName = "User 101";
        $user->emailAddress = "User101@gmail.com";
        $user->phoneNumber = "1234567890";
        
        $userModel->save($user);
    }

    public function insertDataUsingModelEntityUsingMutator()
    {
            // Creating an instance of modal
        $userModel = new UserModel();

        // Creating an instance of entity
        $user = new UserEntity();

        $user->name = "User101";
        $user->email = "user101@gmail.com";
        $user->phone_no = "896543133";
        $user->password = "secret123"; 
        // automatically before insertion to database, this will be in hashed format.

    $userModel->save($user);
    }

    public function insertDataUsingModelEntityUsingAccessor()
    {
            // Creating an instance of modal
            $userModel = new UserModel();

            // Creating an instance of entity
            $users = new UserEntity();
            foreach($users as $index => $user){
                echo $user->name. " , ". $user->email."<br/><br/>";
            }
    }

    public function insertDataUsingModelEntityUsingVirtualProperties()
    {
        // Creating an instance of modal
        $userModel = new UserModel();

        // Creating an instance of entity
        $users = new UserEntity();

        foreach($users as $index => $user){
            echo $user->full_data."<br/><br/>";
        }
    }
}
