<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Qs;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $this->createNewUsers();
    }

    protected function createNewUsers()
    {
        $password = Hash::make('password'); // Default user password

        $d = [

            ['name' => 'Superadmin Miguel',
                'email' => 'miguel@super.com',
                'username' => 'Superadmin Miguel',
                'password' => $password,
                'user_type' => 'super_admin',
                'dob' => '12/03/1998',
                'code' => strtoupper(Str::random(10)),
                'gender' => 'Male',
                'remember_token' => Str::random(10),
            ],

            // ['name' => 'Admin Alex',
            // 'email' => 'alex@admin.com',
            // 'password' => $password,
            // 'user_type' => 'admin',
            // 'username' => 'Admin Alex',
            // 'dob' => '07/23/1996',
            // 'gender' => 'Male',
            // 'code' => strtoupper(Str::random(10)),
            // 'remember_token' => Str::random(10),
            // ],

            // ['name' => 'Teacher Kaisy',
            //     'email' => 'kaisy@teacher.com',
            //     'user_type' => 'teacher',
            //     'username' => 'Teacher Kaisy',
            //     'gender' => 'Female',
            //     'dob' => '04/23/1998',
            //     'password' => $password,
            //     'code' => strtoupper(Str::random(10)),
            //     'remember_token' => Str::random(10),
            // ],

            // ['name' => 'Parent Dian',
            //     'email' => 'dian@parent.com',
            //     'user_type' => 'parent',
            //     'username' => 'Parent Dian',
            //     'gender' => 'Male',
            //     'dob' => '03/23/1998',
            //     'password' => $password,
            //     'code' => strtoupper(Str::random(10)),
            //     'remember_token' => Str::random(10),
            // ],

            // ['name' => 'Accountant Dummy',
            //     'email' => 'dummy@accountant.com',
            //     'user_type' => 'accountant',
            //     'username' => 'accountant',
            //     'password' => $password,
            //     'code' => strtoupper(Str::random(10)),
            //     'remember_token' => Str::random(10),
            // ],
        ];
        DB::table('users')->insert($d);
    }

    protected function createManyUsers(int $count)
    {
        $data = [];
        $user_type = Qs::getAllUserTypes(['super_admin', 'student']);

        for($i = 1; $i <= $count; $i++){

            foreach ($user_type as $k => $ut){

                $data[] = ['name' => ucfirst($user_type[$k]).' '.$i,
                    'email' => $user_type[$k].$i.'@'.$user_type[$k].'.com',
                    'user_type' => $user_type[$k],
                    'username' => $user_type[$k].$i,
                    'password' => Hash::make($user_type[$k]),
                    'code' => strtoupper(Str::random(10)),
                    'remember_token' => Str::random(10),
                ];

            }

        }

        DB::table('users')->insert($data);
    }
}
