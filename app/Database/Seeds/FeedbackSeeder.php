<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'John Doe',
                'email'      => 'john@example.com',
                'message'    => 'Great website! I love the clean design and easy navigation.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Jane Smith',
                'email'      => 'jane@example.com',
                'message'    => 'I found the article about form validation very useful. Thanks for sharing your knowledge!',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('feedback')->insertBatch($data);
    }
}
