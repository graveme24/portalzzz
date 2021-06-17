<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class QuarterlyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quarterlies')->delete();

        $data = [
            ['name' => 'First Quarter'],
            ['name' => 'Second Quarter'],
            ['name' => 'Third Quarter'],
            ['name' => 'Fourth Quarter'],
        ];

        DB::table('quarterlies')->insert($data);
    }
}
