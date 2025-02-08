<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = 'Teacher@12';
        User::insert([
            ['name'=> 'Sneha', 'email'=> 'Sneha@gmail.com', 'password'=> Hash::make($password)],
            ['name'=> 'Ritikesh', 'email'=> 'Ritikesh@gmail.com', 'password'=> Hash::make($password)],
            ['name'=> 'Raj', 'email'=> 'Raj@gmail.com', 'password'=> Hash::make($password)],
            ['name'=> 'Karan', 'email'=> 'Karan@gmail.com', 'password'=> Hash::make($password)],
            ['name'=> 'Shailesh', 'email'=> 'Shailesh@gmail.com', 'password'=> Hash::make($password)],
        ]);
    }
}
