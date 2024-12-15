<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminProfileModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admin_profile';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [  'user_image',
    'name',
    'designation',
    'location',
    'description',
    'date_of_birth',
    'email',
    'mobile',
    'address'];

    public function getProfileById($id)
    {
        return $this->where('id', $id)->first(); // Fetch the profile by ID
    }

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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
