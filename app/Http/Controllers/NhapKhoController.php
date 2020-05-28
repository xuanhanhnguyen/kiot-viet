<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class NhapKhoController extends Controller
{
    // public $timestamps = true;
    public function index()
    {
        $nhapkho = DB::table('nhap_kho')
            ->select('nhap_kho.id as idkho', 'ten_kh', 'ten_sp', 'sl_nhap')
            ->join('khach_hang', 'khach_hang.id', '=', 'nhap_kho.khach_hang_id')
            ->join('san_pham', 'san_pham.id', '=', 'nhap_kho.san_pham_id')
            ->get();
        // dd($users);
        return view('nhapkho.index', compact('nhapkho'));
    }

    public function goadd()
    {
        $khachhang = DB::table('khach_hang')->where('loai_kh', 0)->get();
        $sanpham = DB::table('san_pham')->get();
        return view('nhapkho.add', compact('khachhang', 'sanpham'));
    }

    public function add(Request $request)
    {

        DB::table('nhap_kho')->insert(
            [
                'khach_hang_id' => $request->khach_hang_id,
                'san_pham_id' => $request->san_pham_id,
                'sl_nhap' => $request->sl_nhap,
            ]
        );
        $sl = DB::table('san_pham')->select('so_luong')->where('id', $request->san_pham_id)->first();
        $slsp = $request->sl_nhap + $sl->so_luong;
        DB::table('san_pham')->where('id', $request->san_pham_id)->update(
            [
                'so_luong' => $slsp,
            ]
        );
        return redirect()->back()->with('message', 'Thêm mới thành công');
    }

    public function goedit($id)
    {
        $nhapkho = DB::table('nhap_kho')->select('*')->where('id', $id)->first();
        $khachhang = DB::table('khach_hang')->get();
        $sanpham = DB::table('san_pham')->get();
        return view('nhapkho.edit', compact('nhapkho', 'khachhang', 'sanpham'));
    }

    public function edit(Request $request, $id)
    {

        $kt = DB::table('nhap_kho')->select('san_pham_id', 'sl_nhap')->where('id', $id)->first();

        if ($kt->san_pham_id == $request->san_pham_id) {
            $sl = DB::table('san_pham')->select('so_luong')->where('id', $request->san_pham_id)->first();
            $sl1 = DB::table('nhap_kho')->select('sl_nhap')->where('id', $id)->first();
            $sl2 = $sl->so_luong - $sl1->sl_nhap;
            $sl3 = $sl2 + $request->sl_nhap;
            DB::table('san_pham')->where('id', $request->san_pham_id)->update(
                [
                    'so_luong' => $sl3,
                ]
            );
        } else {

            $a = DB::table('san_pham')->select('so_luong')->where('id', $kt->san_pham_id)->first();
            $b = $a->so_luong - $kt->sl_nhap;
            DB::table('san_pham')->where('id', $kt->san_pham_id)->update(
                [
                    'so_luong' => $b,
                ]
            );

            $slk = DB::table('san_pham')->select('so_luong')->where('id', $request->san_pham_id)->first();
            $slsp = $request->sl_nhap + $slk->so_luong;
            DB::table('san_pham')->where('id', $request->san_pham_id)->update(
                [
                    'so_luong' => $slsp,
                ]
            );

        }

        DB::table('nhap_kho')->where('id', $id)->update(
            [
                'khach_hang_id' => $request->khach_hang_id,
                'san_pham_id' => $request->san_pham_id,
                'sl_nhap' => $request->sl_nhap,
            ]
        );

        return redirect()->back()->with('message', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $idsp = DB::table('nhap_kho')->select('sl_nhap', 'san_pham_id')->where('id', $id)->first();
        $sl = DB::table('san_pham')->select('so_luong')->where('id', $idsp->san_pham_id)->first();
        $slsp = $sl->so_luong - $idsp->sl_nhap;
        DB::table('san_pham')->where('id', $idsp->san_pham_id)->update(
            [
                'so_luong' => $slsp,
            ]
        );
        DB::table('nhap_kho')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Xóa thành công');
    }
}
