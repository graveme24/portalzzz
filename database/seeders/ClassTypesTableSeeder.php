<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_types')->delete();

        $data = [
            ['name' => 'Kinder Garten', 'code' => 'K'],
            ['name' => 'Preschool', 'code' => 'P'],
            ['name' => 'Junior Highschool', 'code' => 'J'],
            ['name' => 'Senior Highschool', 'code' => 'S'],
        ];

        DB::table('class_types')->insert($data);

    }
}