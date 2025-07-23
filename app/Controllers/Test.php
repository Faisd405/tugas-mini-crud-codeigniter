<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        return view('test');
    }
    
    public function post()
    {
        if (strtolower($this->request->getMethod()) === 'post') {
            $data = $this->request->getPost();
            var_dump($data);
            echo "Form submitted successfully!";
        } else {
            echo "Not a POST request";
        }
    }
}
