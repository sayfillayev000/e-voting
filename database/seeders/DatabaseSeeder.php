<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'voter']);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Voter',
            'email' => 'voter@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('voter');

        Candidate::create([
            'name' => 'Candidate1',
            'election_number' => 1,
        ]);
        Candidate::create([
            'name' => 'Candidate2',
            'election_number' => 2,
        ]);
    }
}
