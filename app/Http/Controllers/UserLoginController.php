<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    //



    public function Login(){

        return view('resource.views.auth.login');
    }
}
