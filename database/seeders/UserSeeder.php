<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    const TABLE = 'users';

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table(self::TABLE)->truncate();

        $admin_role = Role::where('name','admin')->first();
        $user_role = Role::where('name','user')->first();

        $admin = new User();
        $admin->name = 'Test_Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = Hash::make('admin@admin.com');
        $admin->email_verified_at = now();
        $admin->remember_token = Str::random(10);
        $admin->save();
        $admin->roles()->attach($admin_role);

        $user = new User();
        $user->name = 'Test_user';
        $user->email = 'user@user.com';
        $user->password = Hash::make('user@user.com');
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();
        $user->roles()->attach($user_role);

        User::factory(5)->create();
        //
    }

}
