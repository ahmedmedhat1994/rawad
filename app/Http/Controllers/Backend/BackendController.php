<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yoeunes\Toastr\Facades\Toastr;

class BackendController extends Controller
{
    public function index(){

        return view('Backend.dashboard');
    }




    public function login(){
        return view('backend.auth.login');
    }
}
