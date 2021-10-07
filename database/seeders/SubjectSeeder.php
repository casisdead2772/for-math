<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    const TABLE = 'subjects';

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table(self::TABLE)->truncate();

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'Math',
            'code' => 'MT',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'Physics',
            'code' => 'PH',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'Chemistry',
            'code' => 'CH',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table(self::TABLE)->insertOrIgnore([
            'name' => 'English',
            'code' => 'En',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
