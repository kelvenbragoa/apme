<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    //

    public function __invoke()
    {
        if(Auth::user()->role_id == 1){
            return view('admin.layouts.app');
        }
        if(Auth::user()->role_id == 2){
            return view('manager.layouts.app');
        }
        if(Auth::user()->role_id == 3){
            return view('associate.layouts.app');
        }
        
    }
}
