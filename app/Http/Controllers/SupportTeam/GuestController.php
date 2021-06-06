<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Mail\TestMail;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\StudentRecord;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function homepage(){
        return view('pages.guest.homepage');
    }
    public function registration(){
        return view('pages.guest.registration');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:6|max:150',
            'gender' => 'required|string',
            'year_admitted' => 'required|string',
            'phone' => 'sometimes|nullable|string|min:6|max:20',
            'email' => 'sometimes|nullable|email|max:100|unique:users',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
            // 'bg_id' => 'sometimes|nullable',
            // 'state_id' => 'required',
            // 'lga_id' => 'required',
            // 'nal_id' => 'required',
            // 'my_class_id' => 'nullable',
            // 'section_id' => 'nullable',
            // 'my_parent_id' => 'sometimes|nullable',
            // 'status' => 'nullable',
        ]);
    }
    public function create(Request $data){
        $sr =  $data->only(Qs::getStudentData());
        $req =  $data->only(Qs::getUserRecord());

        $mail =$data['email'];

        $details = [
            'title' => 'Mail from Haven of Wisdom',
            'body' => 'Kindly login using your email with your password as: student',
        ];
        Mail::to($mail)->send(new TestMail($details));

        $suername = $data['username'] = $sr['year_admitted'].mt_rand(1000, 9999);
            $user = User::create([
                'user_type' => $data['user_type'] = 'student',
                'gender' => $data['gender'],
                'name' => $data['name'],
                'email' =>$data['email'],
                'address' => $data['address'],
                'code' => $data['code'] = strtoupper(Str::random(10)),
                'password' => $data['password'] = Hash::make('student'),
                'photo' => $data['photo'] = Qs::getDefaultUserImage(),
                'year_admitted' => $data['year_admitted'],
                'username' => $suername,
            ]);
            $stud = StudentRecord::create([
                'adm_no' => $suername,
                'user_id'=> $user->id,
                'session'=> Qs::getSetting('current_session'),
            ]);

        return Qs::jsonStoreOk();

        // if($data->hasFile('photo')) {
        //     $photo = $data['photo']->file('photo');
        //     $f = Qs::getFileMetaData($photo);
        //     $f['name'] = 'photo.' . $f['ext'];
        //     $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$data['code'], $f['name']);
        //     $data['photo'] = asset('storage/' . $f['path']);
        // }
    }
}
