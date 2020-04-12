<?php

namespace App\Http\Controllers\Admin;

use App\cthd;
use App\hoa_don;
use App\san_pham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiaoDichController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hoa_don = hoa_don::with('khach_hang', 'user')->get();
        return view('admin.giao_dich.index', compact('hoa_don'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $san_pham = san_pham::where('so_luong', '>', 0)->get();
        return view('admin.giao_dich.create',compact('san_pham'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hoa_don = hoa_don::with('khach_hang', 'user')->find($id);
        $cthd = cthd::with('san_pham')->where('hoa_don_id', $id)->get();
        return response()->json(['hoa_don' => $hoa_don, 'cthd' => $cthd]);
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
