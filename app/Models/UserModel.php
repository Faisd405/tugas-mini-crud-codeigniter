<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['username', 'password', 'email', 'name', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Validation rules
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username,id,{id}]',
        'password' => 'required|min_length[6]|max_length[255]',
        'email'    => 'required|valid_email|max_length[100]|is_unique[users.email,id,{id}]',
        'name'     => 'required|min_length[3]|max_length[100]'
    ];
    
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Username already exists'
        ],
        'email' => [
            'is_unique' => 'Email already exists'
        ]
    ];
    
    protected $skipValidation = false;
    
    // Before insert hook - hash password before saving
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        
        return $data;
    }
    
    // Method to verify user credentials
    public function verifyCredentials($username, $password)
    {
        $user = $this->where('username', $username)->first();
        
        if (is_null($user)) {
            return false;
        }
        
        return password_verify($password, $user->password) ? $user : false;
    }
}
