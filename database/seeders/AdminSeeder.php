<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'jabatan' => 'admin',
                'role' => 'admin',
            ],

            [
                'name' => 'Nur Arifandi Azis, S.H., M.M',
                'username' => 'nurarifandi',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kepala Kantor',
                'role' => 'kepala_kantor',
            ],

            [
                'name' => 'Tajuddin, S.H., M.I.Kom',
                'username' => 'tajuddin',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kaur Tata Usaha',
                'role' => 'tu',
            ],

            [
                'name' => 'Syahrul Tompo, S.E., M.M',
                'username' => 'syahrul',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kasubsi TI & Inteldakim',
                'role' => 'inteldaktim',
            ],

            [
                'name' => 'Andi Muhammad Zulherman, S.H',
                'username' => 'zulherman',
                'password' => Hash::make('12345678'),
                'jabatan' => 'Kasubsi Pelayanan & Verdokjal',
                'role' => 'verdokjal',
            ],

        ];

        foreach ($users as $user) {

            User::create($user);

            Admin::create($user);

        }
    }
}