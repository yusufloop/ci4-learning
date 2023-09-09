<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    private $db;
    
    public function __construct()
    {
        $this->db = db_connect();
    }
    public function index()
    {
        $builder = $this->db->table("my_table");

        $query = $builder->select('*')
            ->groupStart()
                ->where('column1', 'a')
                ->groupStart()
                    ->where('column2', 'b')
                    ->orWhere('column3', 'c')
                ->groupEnd()
            ->groupEnd()
            ->get();
        dd($query->getResult());
    }

    public function index2()
    {
        $builder = $this->db->table("my_table");
        
        $query = $builder->select('*')
            ->groupStart()
                ->where('column1', 'a')
                ->where('column2', 'b')
            ->groupEnd()
            ->orGroupStart()
                ->where('column3', 'c')
                ->where('column4', 'd')
            ->groupEnd()
        ->get();

        dd($query->getResult());

        // To get last executed query
		// $this->db->getLastQuery();
    }
}
