<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('BookSeeder');
        $this->call('ArticleSeeder');
        $this->call('FeedbackSeeder');
        $this->call('UserSeeder');
    }
}
