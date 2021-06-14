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
    public function approve(Request $request){
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
    }
    public function create(Request $data){
        $sr =  $data->only(Qs::getStudentData());
        $req =  $data->only(Qs::getUserRecord());
        request()->validate([
            'name' => 'required|string|min:6|max:150',
            'gender' => 'required|string',
            'phone' => 'sometimes|nullable|string|min:6|max:20',
            'email' => 'sometimes|nullable|email|max:100|unique:users',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
            'address' => 'required|string|min:6|max:120',
            'pob' => 'required|string',
            'rel' => 'sometimes|nullable|string',
            'citizenship' => 'required|string|min:6|max:120',
            'mname' => 'required|string|min:6|max:150',
            'mage' => 'sometimes|nullable|string|min:1|max:2',
            'moccu' => 'sometimes|nullable|string',
            'fname' => 'required|string|min:6|max:150',
            'fage' => 'sometimes|nullable|string|min:1|max:2',
            'foccu' => 'sometimes|nullable|string',
            'gname' => 'required|string|min:6|max:150',
            'grel' => 'required|string',
        ]);

        $yr = now()->year;

        $suername = $data['username'] = $yr.'-'.mt_rand(10000, 99999);
            $user = User::create([
                'user_type' => $data['user_type'] = 'student',
                'gender' => $data['gender'],
                'age' => $data['age'],
                'phone' => $data['phone'],
                'phone2' => $data['phone2'],
                'dob' => $data['dob'],
                'pob' => $data['pob'],
                'rel' => $data['rel'],
                'citizenship' => $data['citizenship'],
                'mname' => $data['mname'],
                'mage' => $data['mage'],
                'moccu' => $data['moccu'],
                'fname' => $data['fname'],
                'fage' => $data['fage'],
                'foccu' => $data['foccu'],
                'gname' => $data['gname'],
                'grel' => $data['grel'],
                'name' => $data['name'],
                'email' =>$data['email'],
                'address' => $data['address'],
                'code' => $data['code'] = strtoupper(Str::random(10)),
                'password' => $data['password'] = Hash::make('student'),
                'photo' => $data['photo'] = Qs::getDefaultUserImage(),
                'username' => $suername,
            ]);
            $status = "0";
            $stud = StudentRecord::create([
                'adm_no' => $suername,
                'user_id'=> $user->id,
                'status' => $status,
                'my_class_id' => $data['my_class_id'],
                'section_id' => $data['section_id'],
                'session'=> Qs::getSetting('current_session'),
                'year_admitted' => $yr,
            ]);
            return redirect()->route('guest')->with('wait', 'Registered Successfully');
            // return redirect()->route('login')->with('success', 'You have no permission for this page!');

        // if($data->hasFile('photo')) {
        //     $photo = $data['photo']->file('photo');
        //     $f = Qs::getFileMetaData($photo);
        //     $f['name'] = 'photo.' . $f['ext'];
        //     $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$data['code'], $f['name']);
        //     $data['photo'] = asset('storage/' . $f['path']);
        // }
    }

}
