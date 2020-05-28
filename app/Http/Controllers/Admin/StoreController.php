<?php

namespace App\Http\Controllers\Admin;

use App\cua_hang;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = DB::table('cua_hang')->get();
        return view('admin.store.home', compact('store'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.store.create');
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
            $file = $request->hinh_anh;
            $file->move('img', $file->getClientOriginalName());
            $data = collect($request->all())->merge([
                'hinh_anh' => $file->getClientOriginalName()
            ])->toArray();

            cua_hang::create($data);

            return redirect('/admin/cua_hang')->with(["message" => "Thêm thành công!"]);
        } catch (\Exception $e) {
            return redirect('/admin/cua_hang')->with(["error" => "Thêm thất bại!"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $store = DB::table('cua_hang')->find($id);
        return view('admin.store.edit', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

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
        try {
            if ($request->hasFile('hinh_anh')) {
                $file = $request->hinh_anh;
                $file->move('img', $file->getClientOriginalName());
                $data = collect($request->all())->merge([
                    'hinh_anh' => $file->getClientOriginalName()
                ])->toArray();
                cua_hang::find($id)->update($data);
            } else {
                $data = collect($request->all())->merge([
                    'hinh_anh' => cua_hang::find($id)->hinh_anh
                ])->toArray();
                cua_hang::find($id)->update($data);
            }

            return redirect('/admin/cua_hang')->with(["message" => "Cập nhật thành công!"]);
        } catch (\Exception $e) {
            return redirect('/admin/cua_hang')->with(["error" => "Cập nhật thất bại!"]);
        }
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
        try {
            cua_hang::findOrFail($id)->delete();
            return redirect()->back()->with(["message" => "Xóa thành công!"]);

        } catch (\Exception $e) {
            return redirect()->back()->with(["error" => "Xóa thất bại, cửa hàng đang có dữ liệu liên quan!"]);
        }
    }
}
