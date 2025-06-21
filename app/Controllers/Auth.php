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
                        'name'       => $user->name,
                        'email'      => $user->email
                    ]);
                    
                    return redirect()->to(site_url('admin/dashboard'));
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
