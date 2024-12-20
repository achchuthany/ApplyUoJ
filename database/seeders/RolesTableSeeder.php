<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'Student';
        $role_user->description = 'Student';
        $role_user->save();

        $role_lecturer = new Role();
        $role_lecturer->name = 'Welfare';
        $role_lecturer->description = 'Welfare Office';
        $role_lecturer->save();

        $role_hod = new Role();
        $role_hod->name = 'Dean';
        $role_hod->description = 'Dean of Faculty';
        $role_hod->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'Administrator';
        $role_admin->save();
    }
}
