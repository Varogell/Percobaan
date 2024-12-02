<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // Update role pengguna berdasarkan email
    $user = \App\Models\User::where('email', 'alvaro@gmail.com')->first();
    $user->role = 'admin'; // Set role menjadi 'admin'
    $user->save();
}

}
