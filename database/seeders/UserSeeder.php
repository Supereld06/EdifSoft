<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Elder Condorcet',
        'email' => 'econdorcet@gmail.com',
        'password' => Hash::make('elder123')
        ]);

        User::create([
        'name' => 'Levi Gomez Cabezas',
        'email' => 'jeseegomezc@gmail.com',
        'password' => Hash::make('LeviJ96')
        ]);
    }
}
