<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // Check if admin user already exists
        $builder = $db->table('users');
        $exists = $builder->where('username', 'admin')->countAllResults();

        if ($exists === 0) {
            $data = [
                'username'   => 'admin',
                'full_name'  => 'Xielef Ferareza',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'avatar'     => 'default.png',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $builder->insert($data);
        }
    }
}