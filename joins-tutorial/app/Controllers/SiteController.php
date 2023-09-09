<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SiteController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = db_connect();
        // OR $this->db = \Config\Database::connect();
    }
    public function innerJoinMethod()
    {
        $builder = $this->db->table("users as user");
        $builder->select('user.*, course.name as course_name');
        $builder->join('courses as course', 'user.id = course.user_id');
        $data = $builder->get()->getResult();
        
        dd($data);
    }
    public function leftJoinMethod()
    {
        $builder = $this->db->table("users as user");
        $builder->select('user.*, course.name as course_name');
        $builder->join('courses as course', 'user.id = course.user_id', "left"); // added left here
        $data =$builder->get()->getResult();

        dd($data);
    }
    public function rightJoinMethod()
    {
        $builder = $this->db->table("users as user");
        $builder->select('user.*, course.name as course_name');
        $builder->join('courses as course', 'user.id = course.user_id', "right"); // added right here
        $data =$builder->get()->getResult();

        dd($data);
    }

}
