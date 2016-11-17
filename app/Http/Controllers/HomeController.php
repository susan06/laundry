<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            return view('dashboard.admin');
        }

        if (Auth::user()->role_id == 2) {
            return view('dashboard.client');
        }

        if (Auth::user()->role_id == 3) {
            return view('dashboard.driver');
        }

        if (Auth::user()->role_id == 4) {
            return view('dashboard.supervisor');
        }

        if (Auth::user()->role_id == 5) {
            return view('dashboard.branch-representative');
        }
    }
}
