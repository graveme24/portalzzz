<?php
namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MyClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_classes')->delete();
        $ct = ClassType::pluck('id')->all();

        $data = [
            ['name' => 'Kindergarten', 'class_type_id' => $ct[0]],
            ['name' => 'Preparatory', 'class_type_id' => $ct[0]],
            ['name' => 'Grade 01', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 02', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 03', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 04', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 05', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 06', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 07', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 08', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 09', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 10', 'class_type_id' => $ct[1]],
            ['name' => 'Grade 11', 'class_type_id' => $ct[2]],
            ['name' => 'Grade 12', 'class_type_id' => $ct[2]],



            ];

        DB::table('my_classes')->insert($data);

    }
}
