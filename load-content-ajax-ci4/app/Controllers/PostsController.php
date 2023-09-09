<?php

namespace App\Controllers;

use App\Models\Posts;
use App\Controllers\BaseController;

class PostsController extends BaseController
{
    public $rowPerPage = 4;

    public function index()
    {
        $posts = new Posts();

        // number of rowperpage 
        $data['rowPerPage'] = $this->rowPerPage;

        //total number of records 
        $data['totalRecords'] = $posts->select('id')->countAllResults();

        //fetch 4 records
        $data['posts'] = $posts->select('*')
                        ->findAll($this->rowPerPage,0);

        return view('index', $data);
    }

    public function getPosts()
    {
        $request = service('request'); 
            $postData = $request->getPost(); 
            $start = $postData['start'];

            // Fetch records
            $posts = new Posts();
            $records = $posts->select('*') 
                         ->findAll($this->rowPerPage, $start);

            $html = "";
            foreach($records as $record){
                  $id = $record['id'];
                  $title = $record['title'];
                  $description = $record['description'];
                  $link = $record['link'];

                  $html .= '<div class="card w-75 post">
                       <div class="card-body">
                            <h5 class="card-title">'.$title.'</h5>
                            <p class="card-text">'.$description.'</p>
                            <a href="'.$link.'" target="_blank" class="btn btn-primary">Read More</a>
                       </div>
                  </div>';
            }

            // New CSRF token
            $data['token'] = csrf_hash();

            // Fetch data
            $data['html'] = $html;

            return $this->response->setJSON($data);
    }
}
