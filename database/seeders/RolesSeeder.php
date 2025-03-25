<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Admin',
                'description' => 'User who can view and edit all pages of the website.',
                'is_active' => true
            ],
            [
                'id' => 2,
                'name' => 'Client',
                'description' => 'User who can view and edit specific pages of the website.',
                'is_active' => true
            ],
            [
                'id' => 3,
                'name' => 'Visitor',
                'description' => 'User who can only view specific pages of the website.',
                'is_active' => true
            ]
        ];

        Role::insert($roles);
    }
}