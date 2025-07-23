<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Admin Login'
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];
            
            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                
                $user = $userModel->verifyCredentials($username, $password);
                
                if ($user) {
                    $session = session();
                    $session->set([
                        'isLoggedIn' => true,
                        'user_id'    => $user->id,
                        'username'   => $user->username,
                        'user_name'  => $user->name,
                        'user_email' => $user->email,
                        'user_role'  => $user->role ?? 'member',
                        'user_profile_picture' => $user->profile_picture
                    ]);
                    
                    // Redirect based on user role
                    if ($user->role === 'admin') {
                        return redirect()->to(site_url('admin/dashboard'));
                    } else {
                        return redirect()->to(site_url('library'));
                    }
                } else {
                    $session = session();
                    $session->setFlashdata('error', 'Invalid username or password');
                    return redirect()->back();
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        
        return view('auth/login', $data);
    }
    
    public function logout()
    {
        $session = session();
        $session->destroy();
        
        return redirect()->to(site_url('auth/login'));
    }
}
