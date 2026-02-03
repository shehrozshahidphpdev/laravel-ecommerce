<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function demo()
    {
        Session::flash("success", "Hell");
        return view('demo');
    }
}
