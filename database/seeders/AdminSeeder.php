<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Mohamed Farag',
            'username' => 'mohamedfarag',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'password' => bcrypt('password')
        ]);
    }
}
