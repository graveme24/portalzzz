<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\StudentRecord;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createStudentRecord();
        // $this->createManyStudentRecords(3);
    }

    // protected function createManyStudentRecords(int $count)
    // {
    //     $sections = Section::all();

    //     foreach ($sections as $section){
    //       User::factory()
    //             ->has(
    //                 StudentRecord::factory()
    //                 ->state([
    //                 'section_id' => $section->id,
    //                 'my_class_id' => $section->my_class_id,
    //                 'user_id' => function(User $user){
    //                     return ['user_id' => $user->id];
    //                 },
    //             ]), 'student_record')
    //             ->count($count)
    //             ->create([
    //                 'user_type' => 'student',
    //                 'password' => Hash::make('student'),
    //             ]);
    //     }

    // }

    protected function createStudentRecord()
    {
        $section = Section::first();

        $user = User::factory()->create([
            'name' => 'Student Miguel',
            'user_type' => 'student',
            'username' => '201900001',
            'password' => Hash::make('password'),
            'email' => 'miguel@student.com',
            'gender' => 'Male',
            'dob' => '12/03/1998',
            'phone' => '09129273098',
            'phone2' => '8268260',
            'pob' => 'Las Piñas City',
            'citizenship' => 'Filipino',
            'mname' => 'Lhet Cosme',
            'mage' => '52',
            'moccu' => 'Housewife',
            'fname' => 'Marvin Cosme',
            'fage' => '53',
            'foccu' => 'Private Driver',
            'gname' => 'Lhet Cosme',
            'grel' => 'Mother',
            'rel' => 'Iglesia ni Cristo'
        ]);

        StudentRecord::factory()->create([
            'my_class_id' => $section->my_class_id,
            'user_id' => $user->id,
            'section_id' => $section->id
        ]);
    }
}
