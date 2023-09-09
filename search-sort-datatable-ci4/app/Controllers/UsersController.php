<?php

namespace App\Controllers;

use App\Models\Users;
use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function getUsers()
    {
        $request = service('request');
        $postData = $request->getPost();
        $dtpostData =$postData['data'];
        $response = array();

        // READ  value 
        $draw = $dtpostData['draw'];
        $start =$dtpostData['start'];
        $rowperpage =$dtpostData['length']; //rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; //column index
        $columnName = $dtpostData['columns'][$columnIndex]['data'];
        $columnSortOrder = $dtpostData['order'][0]['dir']; //asc or desc
        $searchValue = $dtpostData['search']['value'];

        // TOTAL NUMBER OF RECORD WITHOUT FILTERING \
        $users = new Users();
        $totalRecords = $users->select('id')
                        ->countAllResults();

        // TOTAL NUMBER OF RECORD WITH FILTERING 
        $totalRecordwithFilter = $users->select('id')
                                ->orLike('name', $searchValue)
                                ->orLike('email', $searchValue)
                                ->orLike('city', $searchValue)
                                ->countAllResults();


        // FETCH RECORD 
        $records = $users->select('*')
                    ->orLike('name' , $searchValue)
                    ->orLike('email' ,$searchValue)
                    ->orLike('city' ,$searchValue)
                    ->orderBy($columnName, $columnSortOrder)
                    ->findAll($rowperpage, $start);
        
        $data = array();

        foreach($records as $record)
        {
            $data[]= array(
                "id" => $record['id'],
                "name" => $record['name'],
                "email" => $record['email'],
                "city" => $record['city'],
            );
        }

        // response 
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "token" => csrf_token() //new token hash
        );

        return $this->response->setJSON($response);
    }
}
