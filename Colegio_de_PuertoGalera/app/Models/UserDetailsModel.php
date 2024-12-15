<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDetailsModel extends Model
{
    protected $table = 'user_details';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'contact', 'address', 'gender', 'age', 'other_information', 'blood_type'
    ];

    // Optional: you can set validation rules here if needed
    protected $validationRules = [
        'contact' => 'required|min_length[10]|max_length[15]',
        'address' => 'required|min_length[5]|max_length[255]',
        'gender' => 'required',
        'age' => 'required|integer',
        'blood_type' => 'required'
    ];
}
