<?php

namespace Database\Seeders;

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

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@admin.com'), // password
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::factory(5)->create();
        //
    }
}
