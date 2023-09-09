<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Employees;

class EmployeesController extends BaseController
{
    public function index()
    {
        $employees = new Employees();
        $citylists = $employees->select('city')
                ->distinct()
                ->orderBy('city')
                ->findAll();
        $data['citylists'] = $citylists;

        return view('index',$data);
    }

    public function getEmployees(){

        $request = service('request');
        $postData = $request->getPost();
        $dtpostData = $postData['data'];
        $response = array();

        ## Read value
        $draw = $dtpostData['draw'];
        $start = $dtpostData['start'];
        $rowperpage = $dtpostData['length']; // Rows display per page
        $columnIndex = $dtpostData['order'][0]['column']; // Column index
        $columnName = $dtpostData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $dtpostData['order'][0]['dir']; // asc or desc
        $searchValue = $dtpostData['search']['value']; // Search value

        // Custom filter
        $searchByName = $dtpostData['searchByName'];
        $searchByCity = $dtpostData['searchByCity'];

        ## Total number of records without filtering
        $employees = new Employees();
        $totalRecords = $employees->select('id')
                     ->countAllResults();

        ## Total number of records with filtering
        $searchQuery = $employees->select('id');
        if($searchByName != ''){
            $searchQuery->orLike('emp_name', $searchByName);
        }
        if($searchByCity != ''){
            $searchQuery->orLike('city', $searchByCity);
        }
        
        $totalRecordwithFilter = $searchQuery->countAllResults();

        ## Fetch records
        $searchQuery = $employees->select('*');
        if($searchByName != ''){
            $searchQuery->orLike('emp_name', $searchByName);
        }
        if($searchByCity != ''){
            $searchQuery->orLike('city', $searchByCity);
        }
        $records = $searchQuery->orderBy($columnName,$columnSortOrder)
            ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record ){

            $data[] = array( 
                "emp_name"=>$record['emp_name'],
                "email"=>$record['email'],
                "city"=>$record['city'],
                "gender"=>$record['gender']
            ); 
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "token" => csrf_hash() // New token hash
        );

        return $this->response->setJSON($response);
    }
}
