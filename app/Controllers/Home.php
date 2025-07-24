<?php

namespace App\Controllers;

use App\Models\FeedbackModel;
use App\Models\ArticleModel;

class Home extends BaseController
{
    
    protected $helpers = ['form'];
    
    public function index()
    {
        $articleModel = new ArticleModel();
        $data = [
            'title' => 'Home',
            'recent_articles' => $articleModel->getPublished(3) // Get 3 most recent articles
        ];
        return view('welcome_message', $data);
    }

    public function article($slug = null)
    {
        // If no slug provided, redirect to home
        if (empty($slug)) {
            return redirect()->to('/');
        }
        
        $articleModel = new ArticleModel();
        $article = $articleModel->getBySlug($slug);
        
        // If article not found or is a draft, show 404
        if (empty($article) || $article->draft == 1) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Article not found');
        }
        
        // Get a few other articles to display
        $other_articles = $articleModel->getPublished(5);
        
        $data = [
            'title' => $article->title,
            'article' => $article,
            'other_articles' => $other_articles
        ];
        
        return view('article_view', $data);
    }

    public function feedback()
    {
        $data = [
            'title' => 'Feedback Form'
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            // Set validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|valid_email',
                'message' => 'required|min_length[10]'
            ];

            // Validate
            if ($this->validate($rules)) {
                $feedbackModel = new FeedbackModel();
                
                // Insert data
                $feedbackModel->save([
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'message' => $this->request->getPost('message')
                ]);

                // Set success message
                session()->setFlashdata('success', 'Thank you for your feedback!');
                return redirect()->to(site_url('feedback'));
            } else {
                // Validation failed
                $data['validation'] = $this->validator;
            }
        }

        return view('feedback_form', $data);
    }
}
