<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

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
        $date = Carbon::now()->subYears(5); 
        $year = Carbon::now('Asia/Ho_Chi_Minh')->year;
        // dd($year);
        // dd($date);
        $orderYear = DB::table('cthd')
            ->select(DB::raw('MONTH(created_at) as getMonth'), DB::raw('COUNT(*) as value'))                    
            ->where(DB::raw('YEAR(created_at)'), '=', $year)
            ->groupBy('getMonth')
            ->orderBy('getMonth', 'ASC')
            ->get();

            $orderYear1 = DB::table('khach_hang')
            ->select(DB::raw('MONTH(created_at) as getMonth'), DB::raw('COUNT(*) as value'))                    
            ->where(DB::raw('YEAR(created_at)'), '=', $year)
            ->groupBy('getMonth')
            ->orderBy('getMonth', 'ASC')
            ->get();

            $products = DB::table('san_pham')         
            ->orderBy('so_luong', 'ASC')           
            ->where('trang_thai',0)->paginate(10);;
                    // dd($orderYear);
        return view('home', compact('orderYear','orderYear1','products'));        
    }
}
