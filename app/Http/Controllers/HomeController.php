<?php

namespace App\Http\Controllers;

use Auth;
use Settings;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository as Users;
use App\Repositories\Client\ClientFriendRepository as ClientFriend;
use App\Repositories\BranchOffice\BranchOfficeRepository as BranchOffice;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Package\PackageRepository;

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
    public function index(Request $request, ClientFriend $clientFriend, Users $users, BranchOffice $branchOffice)
    {
        if (Auth::user()->role_id == 1) {
            $total['admin'] = $users->where('role_id', 1)->count();
            $total['clients'] = $users->where('role_id', 2)->count();
            $total['drivers'] = $users->where('role_id', 3)->count();
            $total['supervisor'] = $users->where('role_id', 4)->count();
            $total['representants'] = $users->where('role_id', 5)->count();
            $total['branchOffices'] = $branchOffice->all()->count();

            if(Settings::get('working_hours')) {
                $working_hours = json_decode(Settings::get('working_hours'), true);
            } else {
                $working_hours = array();
            }
            foreach($working_hours as $working_hour) {
                $order_by_hour['legend'][] = $working_hour['interval'];
            }
            $order_by_hour['data'] = $this->orders->chart_order_by_hour();

            if(Settings::get('delivery_hours')) {
                $time_delivery = json_decode(Settings::get('delivery_hours'), true);
            } else {
                $time_delivery = array();
            }
            foreach($time_delivery as $time_del) {
                $order_by_hour_delivery['legend'][] = $time_del['interval'];
            }
            $order_by_hour_delivery['data'] = $this->orders->chart_order_by_hour_delivery();

            $order_branchs['data'] = $this->orders->chart_order_branch();
            $friend_invited['data'] = $clientFriend->chart_friend_invited();
            $order_packages['data'] = $this->orders->chart_order_packages();
            $order_payments['data'] = $this->orders->chart_order_payments();
            $order_delivered['data'] = $this->orders->chart_order_delivered();

            return view('dashboard.admin', compact('total', 'order_by_hour', 'order_by_hour_delivery', 'order_branchs', 'friend_invited', 'order_packages', 'order_payments', 'order_delivered'));
        }

        if (Auth::user()->role_id == 2) {
            $count = $this->orders->countDahsboard();
            $order_delivered['data'] = $this->orders->chart_order_delivered(Auth::user()->id);
            return view('dashboard.client', compact('count', 'order_delivered'));
        }

        if (Auth::user()->role_id == 3) {
            if(Settings::get('working_hours')) {
                $working_hours = json_decode(Settings::get('working_hours'), true);
            } else {
                $working_hours = array();
            }
            foreach($working_hours as $working_hour) {
                $order_by_hour['legend'][] = $working_hour['interval'];
            }
            $order_by_hour['data'] = $this->orders->chart_order_by_hour(null, Auth::user()->id);

            if(Settings::get('delivery_hours')) {
                $time_delivery = json_decode(Settings::get('delivery_hours'), true);
            } else {
                $time_delivery = array();
            }
            foreach($time_delivery as $time_del) {
                $order_by_hour_delivery['legend'][] = $time_del['interval'];
            }
            $order_by_hour_delivery['data'] = $this->orders->chart_order_by_hour_delivery(null, Auth::user()->id);

            $order_branchs['data'] = $this->orders->chart_order_branch(null, Auth::user()->id);
            $order_delivered['data'] = $this->orders->chart_order_delivered(null, Auth::user()->id);
            return view('dashboard.driver', compact('order_by_hour', 'order_by_hour_delivery', 'order_branchs', 'order_delivered'));
        }

        if (Auth::user()->role_id == 4) {
            $total['clients'] = $users->where('role_id', 2)->count();
            $total['drivers'] = $users->where('role_id', 3)->count();
            $total['representants'] = $users->where('role_id', 5)->count();
            $total['branchOffices'] = $branchOffice->all()->count();

            if(Settings::get('working_hours')) {
                $working_hours = json_decode(Settings::get('working_hours'), true);
            } else {
                $working_hours = array();
            }
            foreach($working_hours as $working_hour) {
                $order_by_hour['legend'][] = $working_hour['interval'];
            }
            $order_by_hour['data'] = $this->orders->chart_order_by_hour();

            if(Settings::get('delivery_hours')) {
                $time_delivery = json_decode(Settings::get('delivery_hours'), true);
            } else {
                $time_delivery = array();
            }
            foreach($time_delivery as $time_del) {
                $order_by_hour_delivery['legend'][] = $time_del['interval'];
            }
            $order_by_hour_delivery['data'] = $this->orders->chart_order_by_hour_delivery();

            $order_branchs['data'] = $this->orders->chart_order_branch();
            $friend_invited['data'] = $clientFriend->chart_friend_invited();
            $order_packages['data'] = $this->orders->chart_order_packages();
            $order_payments['data'] = $this->orders->chart_order_payments();
            $order_delivered['data'] = $this->orders->chart_order_delivered();

            return view('dashboard.supervisor', compact('total', 'order_by_hour', 'order_by_hour_delivery', 'order_branchs', 'friend_invited', 'order_packages', 'order_payments', 'order_delivered'));
        }

        if (Auth::user()->role_id == 5) {
            $this->select_branch($request, $branchOffice);
            $branch_offices = $branchOffice->where('representative_id', Auth::user()->id)->paginate(10);
            return view('dashboard.branch-representative', compact('branch_offices'));
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
