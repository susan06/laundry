<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository as Users;
use App\Repositories\BranchOffice\BranchOfficeRepository as BranchOffice;
use App\Repositories\Order\OrderRepository;

class HomeController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orders;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderRepository $orders)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone');
        $this->orders = $orders; 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Users $users, BranchOffice $branchOffice)
    {
        if (Auth::user()->role_id == 1) {
            $totalUsers = $users->all();
            $totalClients = $users->where('role_id', "2")->get();
            $totalDrivers = $users->where('role_id', "3")->get();
            $totalBranchOffices = $branchOffice->all();
            return view('dashboard.admin', compact('totalUsers', 'totalClients', 'totalDrivers', 'totalBranchOffices'));
        }

        if (Auth::user()->role_id == 2) {
            $count = $this->orders->countDahsboard();
            return view('dashboard.client', compact('count'));
        }

        if (Auth::user()->role_id == 3) {
            return view('dashboard.driver');
        }

        if (Auth::user()->role_id == 4) {
            return view('dashboard.supervisor');
        }

        if (Auth::user()->role_id == 5) {
            $this->select_branch($request, $branchOffice);
            return view('dashboard.branch-representative');
        }
    }

    /**
     * select in session list branch
     *
     */
    public function select_branch(Request $request, BranchOffice $branchOfficeRepository)
    {
        $branch_offices_all = $branchOfficeRepository->where('representative_id', Auth::user()->id)->where('status', 'In service')->pluck('name', 'id')->all();
        $branch_office = $branchOfficeRepository->where('representative_id', Auth::user()->id)->where('status', 'In service')->first();
        
        if ($request->branch_office_id) {
            $branch_office = $branchOfficeRepository->find($request->branch_office_id);
            session()->put('branch_office', $branch_office); 
        }

        if ( count($branch_offices_all) > 1 && !session('branch_offices')) {
            $branch_offices = ['' => trans('app.select_a_branch_office')] + $branch_offices_all;
            session()->put('branch_offices', $branch_offices); 
        } else {
            if(!session('branch_office')) {
                session()->put('branch_office', $branch_office); 
            }
        }
    }
}
