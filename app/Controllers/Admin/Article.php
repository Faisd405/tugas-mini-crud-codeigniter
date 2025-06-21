<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Article extends BaseController
{
    protected $articleModel;

    protected $helpers = ['form'];

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Article List',
            'articles' => $this->articleModel->findAll()
        ];

        if (count($data['articles']) <= 0) {
            return view('admin/article_empty', $data);
        }

        return view('admin/article_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create New Article'
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            // Set validation rules
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'draft' => 'required|in_list[0,1]'
            ];

            // Validate
            if ($this->validate($rules)) {
                // Generate unique slug
                $slug = url_title($this->request->getPost('title'), '-', true) . '-' . uniqid();
                
                // Insert data
                $this->articleModel->save([
                    'title' => $this->request->getPost('title'),
                    'slug' => $slug,
                    'content' => $this->request->getPost('content'),
                    'draft' => $this->request->getPost('draft')
                ]);

                // Set success message
                session()->setFlashdata('success', 'Article was successfully created');
                return redirect()->to(site_url('admin/article'));
            } else {
                // Validation failed
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/article_form', $data);
    }

    public function edit($id = null)
    {
        if ($id == null) {
            throw new PageNotFoundException('Article not found');
        }

        $article = $this->articleModel->find($id);
        if (!$article) {
            throw new PageNotFoundException('Article not found');
        }

        $data = [
            'title' => 'Edit Article',
            'article' => $article
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            // Set validation rules
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'draft' => 'required|in_list[0,1]'
            ];

            // Validate
            if ($this->validate($rules)) {
                // Update data
                $this->articleModel->save([
                    'id' => $id,
                    'title' => $this->request->getPost('title'),
                    'content' => $this->request->getPost('content'),
                    'draft' => $this->request->getPost('draft'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                // Set success message
                session()->setFlashdata('success', 'Article was successfully updated');
                return redirect()->to(site_url('admin/article'));
            } else {
                // Validation failed
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/article_form', $data);
    }

    public function delete($id = null)
    {
        if ($id == null) {
            throw new PageNotFoundException('Article not found');
        }

        if ($this->articleModel->delete($id)) {
            session()->setFlashdata('success', 'Article was successfully deleted');
        } else {
            session()->setFlashdata('error', 'Failed to delete article');
        }

        return redirect()->to(site_url('admin/article'));
    }
}
