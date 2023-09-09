<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SiteController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect(); //load database
        // OR $this->db = \Config\Database::connect();
    }

    public function innerJoinMethod()
    {
        $builder = $this->db->table("users as user");
        $builder->select('user.*, course.name as course_name');
        $builder->join('courses as course', 'user.id = course.user_id');
        $data = $builder->get()->getResult();

        echo "<pre>";

        dd($data);

        
    }
}
