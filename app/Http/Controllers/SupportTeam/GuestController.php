<?php

namespace App\Http\Controllers\SupportTeam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function homepage(){
        return view('pages.guest.homepage');
    }
    public function registration(){
        return view('pages.guest.registration');
    }
}
