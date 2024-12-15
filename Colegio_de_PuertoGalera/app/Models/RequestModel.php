<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['request_type', 'name', 'course', 'schedule_date', 'schedule_time', 'year', 'status', 'created_a t','updated_at','reject_reason', 'student_id', 'purpose_of_request','specific_documents', 'section', 'contact_number'];
    

    // Fetch the latest notifications (e.g., limit to 5 or 10 notifications)
// In your RequestModel
public function getLatestNotifications($limit = 5)
{
    return $this->select(['id', 'name', 'course', 'request_type', 'created_at'])
                ->where('status', 'Pending')
                ->orderBy('created_at', 'DESC')
                ->findAll($limit);
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
