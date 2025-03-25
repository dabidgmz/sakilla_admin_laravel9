<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = [
            [
                'first_name' => 'Javier',
                'last_name' => 'Resendiz',
                'address_id' => 1,
                'email' => 'javier.res220604@gmail.com',
                'store_id' => 1,
                'active' => 1,
                'username' => 'JVRC',
                'password' => sha1('J22r07c04@'),
                'role_id' => 1,
                'last_update' => now()
            ]
        ];

        Staff::insert($staff);
    }
}
