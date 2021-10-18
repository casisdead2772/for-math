<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{

    const TABLE = 'roles';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table(self::TABLE)->truncate();

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'user',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

}
