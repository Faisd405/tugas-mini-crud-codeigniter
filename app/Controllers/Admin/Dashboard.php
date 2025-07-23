<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\FeedbackModel;
use App\Models\BookModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $articleModel = new ArticleModel();
        $feedbackModel = new FeedbackModel();
        $bookModel = new BookModel();
        
        $data = [
            'title' => 'Dashboard',
            'article_count' => $articleModel->countAll(),
            'feedback_count' => $feedbackModel->countAll(),
            'book_count' => $bookModel->countAll(),
            'available_books' => $bookModel->where('status', 'available')->countAllResults(),
            'borrowed_books' => $bookModel->where('status', 'borrowed')->countAllResults(),
            'maintenance_books' => $bookModel->where('status', 'maintenance')->countAllResults()
        ];
        
        return view('admin/dashboard', $data);
    }
}
