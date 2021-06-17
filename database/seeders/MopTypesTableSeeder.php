<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MopTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mop_types')->delete();

        $data = [
            ['name' => 'Cash'],
            ['name' => 'Quarterly'],
            ['name' => '6 months'],
            ['name' => '10 months'],
        ];

        DB::table('mop_types')->insert($data);
    }
}
