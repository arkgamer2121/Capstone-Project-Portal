<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['student_id', 'name', 'email', 'password','user_type', 'created_at', 'profile_picture', 'verification_code', 'verified', 'is_super_admin', 'status'];

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

        // Method to check if email is verified
        public function isEmailVerified($email)
        {
            $user = $this->where('email', $email)->first();
            if ($user && $user['verified'] == true) {
                return true;
            }
            return false;
        }
        public function updateStatus($userId, $status)
    {
        $data = ['status' => $status];
        $this->db->where('id', $userId);
        $this->db->update('users', $data);
    }
    
    public function getStatus($userId)
    {
        return $this->db->get_where('users', ['id' => $userId])->row('status');
    }
}
