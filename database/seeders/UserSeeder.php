<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(100)->create();
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => 'Nguyễn Văn ' . chr(64 + $i), 
                'email' => 'nguyenvan'.$i.'@gmail.com', 
                'password' => bcrypt('password'), 
                'avatar' => 'demo',
                'publish' => 1,
                'phone' => '090' . rand(1000000, 9999999),
            ]);
        }
    }
}
