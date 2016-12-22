<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository as Users;
use App\Repositories\BranchOffice\BranchOfficeRepository as BranchOffice;

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
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users $users, BranchOffice $branchOffice)
    {
        if (Auth::user()->role_id == 1) {
            $totalUsers = $users->all();
            $totalClients = $users->where('role_id', "2")->get();
            $totalDrivers = $users->where('role_id', "3")->get();
            $totalBranchOffices = $branchOffice->all();
            return view('dashboard.admin', compact('totalUsers', 'totalClients', 'totalDrivers', 'totalBranchOffices'));
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
