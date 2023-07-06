<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DashboardRequest;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboardData(DashboardRequest $request){
        $response = $request->process();
        return response()->json($response);
    }
}
