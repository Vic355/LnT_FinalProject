<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'name' => 'Victor',
        'email' => '123@gmail.com',
        'password' => Hash::make('12345678'),
        'role' => 'admin',
        'phonenumber' => '081111',
    ]);
    }
}
