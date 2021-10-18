<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    const TABLE = 'tags';
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
            'name' => 'Math',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'Geometry',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'Algebra',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'EasyMath',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'BestTasksEver',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
