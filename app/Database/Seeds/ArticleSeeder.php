<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'      => 'Welcome to CodeIgniter 4',
                'slug'       => 'welcome-to-codeigniter-4',
                'content'    => 'CodeIgniter 4 is a PHP framework that helps you build web applications faster with clean, simple syntax.',
                'draft'      => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title'      => 'Learning CRUD Operations',
                'slug'       => 'learning-crud-operations',
                'content'    => 'CRUD stands for Create, Read, Update, and Delete, which are the basic operations for managing data in applications.',
                'draft'      => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title'      => 'Form Validation in CodeIgniter',
                'slug'       => 'form-validation-in-codeigniter',
                'content'    => 'Form validation is important to ensure data integrity and security in web applications.',
                'draft'      => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('articles')->insertBatch($data);
    }
}
