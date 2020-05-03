<?php

namespace App\Http\Controllers\Admin;

use App\cham_cong;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChamCongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $date = getdate();
        $data = cham_cong::with('user')->where('thang', $date['mon'])->where('nam', $date['year'])->get();
        return view('admin.cham_cong.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $date = getdate();
        $arr = [0];
        for ($i = 0; $i < $date['mday']; $i++) {
            $arr[$i] = 0;
        }

        $user_id = DB::select('SELECT id FROM users WHERE id NOT IN (SELECT id FROM cham_cong WHERE thang= 5 and nam = 2020)');
        foreach ($user_id as $val) {
            cham_cong::create([
                'user_id' => $val->id,
                'ngay_cong' => implode(',', $arr),
                'thang' => $date['mon'],
                'nam' => $date['year'],
            ]);
        }
        $data = cham_cong::with('user')->where('thang', $date['mon'])->where('nam', $date['year'])->get();
        return view('admin.cham_cong.create', compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $date = getdate();
            foreach ($request->arr as $val) {
                $item = cham_cong::findOrFail($val['id']);
                $arr = explode(',', $item->ngay_cong);
                $arr[$date['mday']] = $val['value'];
                $item->update(['ngay_cong' => implode(',', $arr)]);
            }
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($thang, $nam)
    {
        $data = cham_cong::with('user')->where('thang', $thang)->where('nam', $nam)->get();
        return $data;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
