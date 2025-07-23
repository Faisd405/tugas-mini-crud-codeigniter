<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    protected $userModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Display registration form and handle registration
     */
    public function index()
    {
        $data = [
            'title' => 'Register - Digital Library',
            'validation' => null
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            // Validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
                'email' => 'required|valid_email|max_length[100]|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                $userData = [
                    'name' => $this->request->getPost('name'),
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'role' => 'member',
                    'status' => 'active'
                ];

                if ($this->userModel->save($userData)) {
                    session()->setFlashdata('success', 'Registration successful! You can now login.');
                    return redirect()->to('/auth/login');
                } else {
                    session()->setFlashdata('error', 'Failed to register user!');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/register', $data);
    }
}
