<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; 

class ProductController extends Controller
{    
    // public $timestamps = true;
    public function index(){
        $products = DB::table('san_pham')->where('trang_thai',0)->get();
        // dd($users);
        return view('product.index', compact('products'));
    }
    public function goadd(){
        return view('product.add');
    }
    public function add(Request $request){        
        $file = $request->hinh_anh;
        $file->move('img', $file->getClientOriginalName());
        DB::table('san_pham')->insert(
            [
                'ten_sp' => $request->ten_sp,
                'so_luong' => $request->so_luong,
                'hinh_anh' => $file->getClientOriginalName(),
                'gia' => $request->gia,
                'sale' => $request->sale,
                'mo_ta'=> $request->mo_ta,
                'trang_thai'=>0,
            ]
        );
        return redirect()->back()->with('message', 'Thêm mới thành công');
    }
    public function goedit($id){
        $products = DB::table('san_pham')->select('*')->where('id',$id)->get();
        return view('product.edit',compact('products'));
    }
    public function edit(Request $request,$id){
        $file = $request->hinh_anh;
        if($request->hasFile('hinh_anh')){
        $file->move('img', $file->getClientOriginalName());
        DB::table('san_pham')->where('id',$id)->update(
            [
                'ten_sp' => $request->ten_sp,
                'so_luong' => $request->so_luong,
                'hinh_anh' => $file->getClientOriginalName(),
                'gia' => $request->gia,
                'sale' => $request->sale,
                'mo_ta'=> $request->mo_ta,
                'trang_thai'=>0,
            ]
        );}else{
            DB::table('san_pham')->where('id',$id)->update(
                [
                    'ten_sp' => $request->ten_sp,
                    'so_luong' => $request->so_luong,                 
                    'gia' => $request->gia,
                    'sale' => $request->sale,
                    'mo_ta'=> $request->mo_ta,
                    'trang_thai'=>0,
                ]
            ); 
        }
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
    public function delete($id){        
        DB::table('san_pham')->where('id',$id)->update(['trang_thai' => 1,]);
        return redirect()->back()->with('message', 'Xóa thành công');
    }
}
