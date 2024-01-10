<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            // 'photo'=>'Belum ada',
            'nama' => 'Aji Sanjaya',
            'username' => 'Admin',
            'password' => Hash::make('admin123')
        ]);
    }
}
