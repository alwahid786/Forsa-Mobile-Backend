<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'email' => 'admin@admin.com'
        ],[
            'name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Test@123'),
            'username' => 'admin',
            'is_business' => '0',
            'user_type' => 'admin'
        ]);
    }
}
