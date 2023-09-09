<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }
    public function index()
    {
        $builder = $this->db->table("students");
        $builder->select('*');
        $builder->like('name', 'S', 'after');  
        $query = $builder->get();

        // dd($query->getResultArray());

        $builder ->select('*');
        $builder->like('email', 'yahoo.com', 'before');
        $query = $builder->get();

        // dd($query->getResult());

        $builder->select('*');
        $builder->like('phone_no','321','both');
        $query = $builder->get();

        // dd($query->getResult());

        $builder->select('*');
        $builder->like('name','S','after');
        $builder->orLike('phone_no','321','both');
        $query = $builder->get();

        // dd($query->getResult());

        	$builder->select('*');
         	$builder->notLike('phone_no','321','both');
         	$query = $builder->get();
            
             dd($query->getResult());
    
    }
}
