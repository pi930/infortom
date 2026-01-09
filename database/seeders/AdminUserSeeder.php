<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'thomaspierrard522@outlook.fr'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('Sauveur.Ap1624'),
                'role' => 'admin',
                'phone' => '0600000000',

            ]
        );
    }
}

