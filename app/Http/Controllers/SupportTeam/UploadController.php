<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use App\Helpers\Qs;
use App\Http\Requests\Student\StudentRecordUpdate;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(StudentRecordUpdate $req, $sr_id){
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $sr = $this->student->getRecord(['id' => $sr_id])->first();
        $d =  $req->only(Qs::getUserRecord());
        $d['name'] = ucwords($req->name);

        if($req->hasFile('formg')) {
            $photo = $req->file('formg');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'formg.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$sr->user->code, $f['name']);
            $d['formg'] = asset('storage/' . $f['path']);
        }
        if($req->hasFile('bc')) {
            $photo = $req->file('bc');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'bc.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$sr->user->code, $f['name']);
            $d['bc'] = asset('storage/' . $f['path']);
        }
        if($req->hasFile('goodm')) {
            $photo = $req->file('goodm');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = 'goodm.' . $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath('student').$sr->user->code, $f['name']);
            $d['goodm'] = asset('storage/' . $f['path']);
        }

        $this->user->update($sr->user->id, $d);
    }
}
