<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "name",
        "email",
        "password",
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        "name" => "required|min_length[3]|max_length[255]",
        "email" => "required|valid_email|is_unique[members.email]",
        "mobile" => "required",
    ];
    protected $validationMessages   = [
        "name" => [
            "required" => "Name is required",
            "min_length" => "Name must have at least 3 characters in length",
            "max_length" => "Name must not exceed 255 characters in length",
        ],
        "email" => [
            "required" => "Email is required",
            "valid_email" => "Email must be a valid email address",
            
        ],
        "mobile" => [
            "required" => "Mobile is required",
        ],
    ];
    
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
