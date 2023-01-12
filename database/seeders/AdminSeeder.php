<?php

namespace Database\Seeders;

use App\Models\admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admin::create([
            "name" => 'Admin',
            "email" => 'admin@gmail.com',
            "mobile" => '00970597551656',
            "password" => Hash::make(123456),
        ]);
    }
}