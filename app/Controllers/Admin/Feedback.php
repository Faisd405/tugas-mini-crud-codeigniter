<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Feedback extends BaseController
{
    protected $feedbackModel;
    
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->feedbackModel = new FeedbackModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Feedback List',
            'feedbacks' => $this->feedbackModel->findAll()
        ];

        if (count($data['feedbacks']) <= 0) {
            return view('admin/feedback_empty', $data);
        }

        return view('admin/feedback_list', $data);
    }

    public function delete($id = null)
    {
        if ($id == null) {
            throw new PageNotFoundException('Feedback not found');
        }

        if ($this->feedbackModel->delete($id)) {
            session()->setFlashdata('success', 'Feedback was successfully deleted');
        } else {
            session()->setFlashdata('error', 'Failed to delete feedback');
        }

        return redirect()->to(site_url('admin/feedback'));
    }
}
