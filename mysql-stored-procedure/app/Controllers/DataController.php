<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DataController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = db_connect();
    }
    public function listBlogs()
    {
        $blogs = $this->db->query("CALL getBlogs()")->getResult();

        dd($blogs);
    }

    public function singleBlog($id)
    {
        $single_blog = $this->db->query("CALL getSingleBlogDetail(" . $id . ")")->getRow();
    
        dd($single_blog);
    }
}
