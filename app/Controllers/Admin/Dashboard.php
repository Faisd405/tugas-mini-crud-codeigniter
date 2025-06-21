<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\FeedbackModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $articleModel = new ArticleModel();
        $feedbackModel = new FeedbackModel();
        
        $data = [
            'title' => 'Dashboard',
            'article_count' => $articleModel->countAll(),
            'feedback_count' => $feedbackModel->countAll()
        ];
        
        return view('admin/dashboard', $data);
    }
}
