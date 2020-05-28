<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $store = DB::table('cua_hang')->get();
        return view('admin.nhan_vien.index', compact('user','store'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $store = DB::table('cua_hang')->get();
        return view('admin.nhan_vien.create', compact('store'));
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
        $request->validate([
            'email' => 'unique:users'
        ], [
            'email.unique' => 'Email đã tồn tại!'
        ]);

        $data = collect($request->all())->merge([
            'password' => '123456'
        ])->toArray();
        User::create($data);
        return redirect('/admin/nhan_vien')->with(["message" => "Thêm thành công!"]);
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
        $user = User::findOrFail($id);
        $store = DB::table('cua_hang')->get();
        return view('admin.nhan_vien.edit', compact('user','store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = Auth::user()->id;
        return view('admin.user.password', compact('id'));
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
        try {
            if (isset($request->password_config)) {
                if ($request->password_config == $request->password) {
                    $data = collect($request->all())->merge([
                        'password' => Hash::make($request->password)
                    ])->toArray();
                    unset($data['password_config']);
                    User::findOrFail($id)->update($data);
                    return redirect('/admin/nhan_vien/password')->with("message", "Cập nhật thành công!");
                } else {
                    return redirect('/admin/nhan_vien/password')->with(["error" => "Mật khẩu không trùng khớp!"]);
                }
            } elseif (isset($request->trang_thai) && $request->trang_thai == 1) {
                $data = collect($request->all())->merge([
                    'password' => Hash::make('123456')
                ])->toArray();
                User::findOrFail($id)->update($data);
            } else {
                $data = collect($request->all())->merge([
                    'password' => '123456'
                ])->toArray();
                User::findOrFail($id)->update($data);
            }
            return redirect('/admin/nhan_vien')->with("message", "Cập nhật thành công!");
        } catch (\Exception $e) {
            return redirect('/admin/nhan_vien')->with(["error" => "Cập nhật không thành công!"]);
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
        User::findOrFail($id)->delete();
        return redirect()->back()->with(["message" => "Xóa thành công!"]);
    }
}
