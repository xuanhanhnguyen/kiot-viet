<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; 

class CustomerController extends Controller
{    
    // public $timestamps = true;
    public function index(){
        $customers = DB::table('khach_hang')->where('trang_thai',0)->where('loai_kh',1)->get();
        // dd($users);
        return view('customer.index', compact('customers'));
    }
    public function goadd(){
        return view('customer.add');
    }
    public function add(Request $request){              
        DB::table('khach_hang')->insert(
            [
                'ten_kh' => $request->ten_kh,
                'dia_chi' => $request->dia_chi,               
                'email' => $request->email,
                'dien_thoai' => $request->dien_thoai,
                'loai_kh'=> 1,
                'trang_thai'=>0,
            ]
        );
        return redirect()->back()->with('message', 'Thêm mới thành công');
    }
    public function goedit($id){
        $customers = DB::table('khach_hang')->select('*')->where('id',$id)->get();
        return view('customer.edit',compact('customers'));
    }
    public function edit(Request $request,$id){     
        DB::table('khach_hang')->where('id',$id)->update(
            [
                'ten_kh' => $request->ten_kh,
                'dia_chi' => $request->dia_chi,               
                'email' => $request->email,
                'dien_thoai' => $request->dien_thoai,
                'loai_kh'=> 1,
                'trang_thai'=>0,
            ]
        );
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
    public function delete($id){        
        DB::table('khach_hang')->where('id',$id)->update(['trang_thai' => 1,]);
        return redirect()->back()->with('message', 'Xóa thành công');
    }
}
