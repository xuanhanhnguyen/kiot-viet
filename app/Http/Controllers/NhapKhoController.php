<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; 

class NhapKhoController extends Controller
{    
    // public $timestamps = true;
    public function index(){
        $nhapkho = DB::table('nhap_kho')
        ->select('nhap_kho.id as idkho','ten_kh','ten_sp','sl_nhap')
        ->join('khach_hang', 'khach_hang.id', '=', 'nhap_kho.khach_hang_id')
        ->join('san_pham', 'san_pham.id', '=', 'nhap_kho.san_pham_id')
        ->get();
        // dd($users);
        return view('nhapkho.index', compact('nhapkho'));
    }
    public function goadd(){
        $khachhang = DB::table('khach_hang')->get();
        $sanpham = DB::table('san_pham')->get();
        return view('nhapkho.add', compact('khachhang','sanpham'));
    }
    public function add(Request $request){        
     
        DB::table('nhap_kho')->insert(
            [
                'khach_hang_id' => $request->khach_hang_id,
                'san_pham_id' => $request->san_pham_id,                
                'sl_nhap' => $request->sl_nhap,              
            ]
        );
        return redirect()->back()->with('message', 'Thêm mới thành công');
    }
    public function goedit($id){
        $nhapkho = DB::table('nhap_kho')->select('*')->where('id',$id)->first();
        $khachhang = DB::table('khach_hang')->get();
        $sanpham = DB::table('san_pham')->get();
        return view('nhapkho.edit',compact('nhapkho','khachhang','sanpham'));
    }
    public function edit(Request $request,$id){      
        DB::table('nhap_kho')->where('id',$id)->update(
            [
                'khach_hang_id' => $request->khach_hang_id,
                'san_pham_id' => $request->san_pham_id,                
                'sl_nhap' => $request->sl_nhap, 
            ]
        );
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
    public function delete($id){        
        DB::table('nhap_kho')->where('id',$id)->delete();
        return redirect()->back()->with('message', 'Xóa thành công');
    }
}
