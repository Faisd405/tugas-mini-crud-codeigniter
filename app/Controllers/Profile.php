<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Profile extends BaseController
{
    protected $userModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Display user profile
     */
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound('User not found');
        }

        $data = [
            'title' => 'My Profile - Digital Library',
            'user' => $user
        ];

        return view('profile/index', $data);
    }

    /**
     * Edit profile form
     */
    public function edit()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound('User not found');
        }

        $data = [
            'title' => 'Edit Profile - Digital Library',
            'user' => $user,
            'validation' => null
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            // Validation rules for profile update
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => "required|valid_email|max_length[100]|is_unique[users.email,id,{$userId}]",
                'phone' => 'permit_empty|max_length[20]',
                'address' => 'permit_empty',
                'birth_date' => 'permit_empty|valid_date',
                'gender' => 'permit_empty|in_list[male,female]',
                'bio' => 'permit_empty|max_length[500]'
            ];

            // Add password validation only if password is provided
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $rules['password'] = 'required|min_length[6]|max_length[255]';
                $rules['password_confirm'] = 'required|matches[password]';
            }

            if ($this->validate($rules)) {
                $updateData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'phone' => $this->request->getPost('phone'),
                    'address' => $this->request->getPost('address'),
                    'birth_date' => $this->request->getPost('birth_date'),
                    'gender' => $this->request->getPost('gender'),
                    'bio' => $this->request->getPost('bio')
                ];

                // Add password to update data if provided
                if (!empty($password)) {
                    $updateData['password'] = $password;
                }

                $this->userModel->update($userId, $updateData);
                // Update session data
                session()->set([
                    'user_name' => $updateData['name'],
                    'user_email' => $updateData['email']
                ]);

                session()->setFlashdata('success', 'Profile updated successfully');
                return redirect()->to('/profile');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('profile/edit', $data);
    }

    /**
     * Upload profile picture
     */
    public function uploadPicture()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            $userId = session()->get('user_id');
            
            // Validation rules for file upload
            $rules = [
                'profile_picture' => [
                    'rules' => 'uploaded[profile_picture]|is_image[profile_picture]|max_size[profile_picture,2048]',
                    'errors' => [
                        'uploaded' => 'Please select a profile picture.',
                        'is_image' => 'Please select a valid image file.',
                        'max_size' => 'Image size should not exceed 2MB.'
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                $file = $this->request->getFile('profile_picture');
                
                if ($file->isValid() && !$file->hasMoved()) {
                    // Delete old profile picture if exists
                    $user = $this->userModel->find($userId);
                    if ($user->profile_picture) {
                        $oldPicturePath = WRITEPATH . 'uploads/profiles/' . $user->profile_picture;
                        if (file_exists($oldPicturePath)) {
                            unlink($oldPicturePath);
                        }
                    }

                    // Upload new picture
                    $newFileName = $this->userModel->uploadProfilePicture($userId, $file);
                    
                    if ($newFileName) {
                        // Update session with new profile picture
                        session()->set('user_profile_picture', $newFileName);
                        session()->setFlashdata('success', 'Profile picture updated successfully');
                    } else {
                        session()->setFlashdata('error', 'Failed to upload profile picture');
                    }
                } else {
                    session()->setFlashdata('error', 'Failed to upload file');
                }
            } else {
                session()->setFlashdata('error', $this->validator->getErrors());
            }
        }

        return redirect()->to('/profile');
    }

    /**
     * Delete profile picture
     */
    public function deletePicture()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if ($user && $user->profile_picture) {
            // Delete file from server
            $picturePath = WRITEPATH . 'uploads/profiles/' . $user->profile_picture;
            if (file_exists($picturePath)) {
                unlink($picturePath);
            }

            // Remove from database
            $this->userModel->update($userId, ['profile_picture' => null]);
            
            // Update session
            session()->set('user_profile_picture', null);
            
            session()->setFlashdata('success', 'Profile picture deleted successfully');
        } else {
            session()->setFlashdata('error', 'No profile picture to delete');
        }

        return redirect()->to('/profile');
    }

    public function profilePicture($filename = null)
    {
        $path = WRITEPATH . 'uploads/profiles/' . $filename;

        if (!is_file($path)) {
            // Jika tidak ada file, kirim gambar default
            return redirect()->to('/images/default-profile.png');
        }

        $mime = mime_content_type($path);
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setBody(file_get_contents($path));
    }
}
