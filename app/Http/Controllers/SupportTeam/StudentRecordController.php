<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Helpers\Mk;
use App\Http\Requests\Student\StudentRecordCreate;
use App\Http\Requests\Student\StudentRecordUpdate;
use App\Repositories\LocationRepo;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\StudentRecord;
use Chatify\Facades\ChatifyMessenger as Chatify;
use App\User;
Use Illuminate\Http\Request;

class StudentRecordController extends Controller
{
    protected $loc, $my_class, $user, $student;

   public function __construct(LocationRepo $loc, MyClassRepo $my_class, UserRepo $user, StudentRepo $student)
   {
       $this->middleware('teamSA', ['only' => ['edit','update', 'reset_pass', 'create', 'store', 'graduated'] ]);
       $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->loc = $loc;
        $this->my_class = $my_class;
        $this->user = $user;
        $this->student = $student;
   }

    public function reset_pass($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        $data['password'] = Hash::make('student');
        // dd($data);
        $this->user->update($st_id, $data);
        return back()->with('flash_success', __('msg.p_reset'));
    }

    public function approve(StudentRecord $req, $id){

        $sr = $this->student->getRecord(['user_id' => $id])->first();
        $tr = $this->user->find(['id' => $id])->first();
        $yr = now()->year;
        $adm = $yr.'-'.mt_rand(10000, 99999);
        $mail =$tr->email;
        $details = [
            'title' => 'Mail from Haven of Wisdom',
            'body' => 'Kindly login using your email with your password as: student',
        ];
        if ($sr->status == '1')
            $sr->status = '0';
        else if ($sr->status  == '0')
                if ($sr->adm_no = $sr->adm_no)
                    $sr->status = '1' and
                    $sr->adm_no = $sr->adm_no and
                    Mail::to($mail)->send(new TestMail($details));
                else
                    $sr->status = '1'and
                    $sr->adm_no = $adm and
                    Mail::to($mail)->send(new TestMail($details));
        $sr->save();
        return back()->with('success','Activated Succesfully');
    }
    public function toapprove()
    {
        $not = StudentRecord::where('status', '0')->get();
        // $sr = $this->sr

        return view('pages.support_team.students.toapprove', compact('not'));
    }


    public function create()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        // $data['dorms'] = $this->student->getAllDorms();
        // $data['states'] = $this->loc->getStates();
        // $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.students.add', $data);
    }

    public function store(StudentRecordCreate $req)
    {
       $data =  $req->only(Qs::getUserRecord());
       $sr =  $req->only(Qs::getStudentData());

        $ct = $this->my_class->findTypeByClass($req->my_class_id)->code;
        $ct = ($ct == 'J') ? 'JHS' : $ct;
        $ct = ($ct == 'S') ? 'SHS' : $ct;

        $data['user_type'] = 'student';
        $data['name'] = ucwords($req->name);
        $data['code'] = strtoupper(Str::random(10));
        $data['password'] = Hash::make('student');
        $data['photo'] = Qs::getDefaultUserImage();
        $data['username'] = $sr['year_admitted'].'-'.mt_rand(10000, 99999);

        if ($req->hasFile('photo')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();

            $file = $req->file('photo');
            // if size less than 150MB
            if ($file->getSize() < 150000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed_images)) {
                    // delete the older one
                    if (Auth::user()->avatar != config('chatify.user_avatar.default')) {
                        $path = storage_path('app/' . config('chatify.user_avatar.folder') . '/' . Auth::user()->avatar);
                        if (file_exists($path)) {
                            @unlink($path);
                        }
                    }
                    // upload
                    $avatar = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $update = User::where('id', Auth::user()->id)->update(['avatar' => $avatar]);
                    $file->storeAs("/" . config('chatify.user_avatar.folder'), $avatar);

                    $success = $update ? 1 : 0;
                } else {
                    $msg = "File extension not allowed!";
                    $error = 1;
                }
            } else {
                $msg = "File extension not allowed!";
                $error = 1;
            }
        }

        $mail =$data['email'];

        $details = [
            'title' => 'Mail from Haven of Wisdom - Alapan',
            'body' => 'You may now login to your account, the default password is: "student".',
        ];
        Mail::to($mail)->send(new TestMail($details));
        $status = "1";
        $user = $this->user->create($data); // Create User

        $sr['adm_no'] = $data['username'];
        $srec['mop_id'] = ($req->mop_id);
        $sr['user_id'] = $user->id;
        $sr['status'] = "1";
        $sr['session'] = Qs::getSetting('current_session');

        $this->student->createRecord($sr);// Create Student

        return Qs::jsonStoreOk();
    }


    public function listByClass($class_id)
    {
        $data['my_class'] = $mc = $this->my_class->getMC(['id' => $class_id])->first();
        $data['students'] = $this->student->findStudentsByClass($class_id);
        $data['sections'] = $this->my_class->getClassSections($class_id);

        return is_null($mc) ? Qs::goWithDanger() : view('pages.support_team.students.list', $data);
    }

    public function graduated()
    {
        $data['my_classes'] = $this->my_class->all();
        $data['students'] = $this->student->allGradStudents();

        return view('pages.support_team.students.graduated', $data);
    }

    public function not_graduated($sr_id)
    {
        $d['grad'] = 0;
        $d['grad_date'] = NULL;
        $d['session'] = Qs::getSetting('current_session');
        $this->student->updateRecord($sr_id, $d);

        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function show($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();


        /* Prevent Other Students/Parents from viewing Profile of others */
        if(Auth::user()->id != $data['sr']->user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild($data['sr']->user_id, Auth::user()->id)){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('pages.support_team.students.show', $data);
    }

    public function edit($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->student->getRecord(['id' => $sr_id])->first();
        $data['my_classes'] = $this->my_class->all();
        $data['parents'] = $this->user->getUserByType('parent');
        // $data['dorms'] = $this->student->getAllDorms();
        // $data['states'] = $this->loc->getStates();
        // $data['nationals'] = $this->loc->getAllNationals();
        return view('pages.support_team.students.edit', $data);
    }

    public function update(StudentRecordUpdate $req, $sr_id)
    {
        $ct = $this->my_class->findTypeByClass($req->my_class_id)->code;
        $ct = ($ct == 'J') ? 'JHS' : $ct;
        $ct = ($ct == 'S') ? 'SHS' : $ct;
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['id' => $sr_id])->first();
        $d =  $req->only(Qs::getUserRecord());
        $d =  $req->only(Qs::getStudentData());
        $d['name'] = ucwords($req->name);
        $d['gender'] = ($req->gender);
        $d['dob'] = ($req->dob);
        $d['phone'] = ($req->phone);
        $d['address'] = ($req->address);
        $d['email'] = ($req->email);
        $uname = $d['year_admitted'].'-'.mt_rand(10000, 99999);

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'photo.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$sr->user->code, $f['name']);
            $d['photo'] = asset('storage/' . $f['path']);
        }
        $this->user->update($sr->user->id, $d); // Update User Details

        $srec = $req->only(Qs::getStudentData());
        $srec['mop_id'] = ($req->mop_id);
        // $srec['adm_no'] = $uname;
        $srec['session'] = Qs::getSetting('current_session');

        $this->student->updateRecord($sr_id, $srec, $d); // Update St Rec

        /*** If Class/Section is Changed in Same Year, Delete Marks/ExamRecord of Previous Class/Section ****/
        Mk::deleteOldRecord($sr->user->id, $srec['my_class_id']);

        return Qs::jsonUpdateOk();
    }

    public function destroy($st_id)
    {
        $st_id = Qs::decodeHash($st_id);
        if(!$st_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['user_id' => $st_id])->first();
        $path = Qs::getUploadPath('student').$sr->user->code;
        Storage::exists($path) ? Storage::deleteDirectory($path) : false;
        $this->user->delete($sr->user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }


}
