<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
        $admin = new User();
        $admin->name = 'Supper Administrator';
        $admin->email = 'sis@univ.jfn.ac.lk';
        $admin->email_verified_at = Carbon::now();
        $admin->password = bcrypt('achchuthan');
        $admin->phone_number = '0094212226714';
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
