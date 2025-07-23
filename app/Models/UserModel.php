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
    protected $allowedFields = [
        'username', 'password', 'email', 'name', 'profile_picture', 
        'phone', 'address', 'birth_date', 'gender', 'bio', 'role', 'status', 
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
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
    
    // Method to update profile without password
    public function updateProfile($id, $data)
    {
        // Remove password from data if it's empty
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        }
        
        return $this->update($id, $data);
    }
    
    // Method to get user by role
    public function getUsersByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }
    
    // Method to get active users
    public function getActiveUsers()
    {
        return $this->where('status', 'active')->findAll();
    }
    
    // Method to upload profile picture
    public function uploadProfilePicture($userId, $file)
    {
        $uploadPath = WRITEPATH . 'uploads/profiles/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            
            // Update user profile picture
            $this->update($userId, ['profile_picture' => $newName]);
            
            return $newName;
        }
        
        return false;
    }
}
