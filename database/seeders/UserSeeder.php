<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name'     => 'Admin',
            'email'    => 'admin@app.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'status'   => true
        ]);
    }
}
