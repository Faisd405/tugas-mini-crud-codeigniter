<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProfileFieldsToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'profile_picture' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'name'
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'profile_picture'
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'phone'
            ],
            'birth_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'address'
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['male', 'female'],
                'null'       => true,
                'after'      => 'birth_date'
            ],
            'bio' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'gender'
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'librarian', 'member'],
                'default'    => 'member',
                'after'      => 'bio'
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'suspended'],
                'default'    => 'active',
                'after'      => 'role'
            ]
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'profile_picture',
            'phone',
            'address',
            'birth_date',
            'gender',
            'bio',
            'role',
            'status'
        ]);
    }
}
