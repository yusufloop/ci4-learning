<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
    }
    public function index(): string
    {
        $builder =$this->db->table("students");

        $builder->selectCount('id', 'total_students');
        $builder->select('marks');
        $builder->groupBy('marks');
        $query = $builder->get();

        // dd($query->getResult());

        $builder->selectCount('id', 'total_students');
        $builder->select('status');
        $builder->groupBy('status');
        $query1 = $builder->get();
        
        // dd($query1->getResult());

        $builder->selectCount('id','total_students');
		$builder->select('marks, status');
		$builder->groupBy(['marks', 'status']);
		$query2 = $builder->get();

        dd($query2->getResult());
    }
}
