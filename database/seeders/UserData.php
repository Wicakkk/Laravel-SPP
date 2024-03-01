<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'username' => 'admin',
                'password' => 'admin',
                'nama' => 'Admin',
                'level' => 'admin',
            ],
            [
                'username' => 'tono',
                'password' => '1234',
                'nama' => 'Tono',
                'level' => 'siswa',
            ],
            [
                'username' => 'petugas',
                'password' => 'petugas',
                'nama' => 'Petugas',
                'level' => 'petugas',
            ]
         ];

         foreach ($user as $key => $value) {
            User::create($value);
         }
    }
}
