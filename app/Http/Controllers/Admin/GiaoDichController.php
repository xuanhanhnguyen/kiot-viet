<?php

namespace App\Http\Controllers\Admin;

use App\cthd;
use App\hoa_don;
use App\khach_hang;
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
        $khach_hang = khach_hang::where('trang_thai', 0)->where('loai_kh', 1)->get();
        return view('admin.giao_dich.create', compact('san_pham', 'khach_hang'));
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
            if (isset($request->text_kh)) {
                $dataKH = explode(",", $request->text_kh);
                $kh = khach_hang::updateOrCreate(['ten_kh' => trim($dataKH[0], " "), 'dien_thoai' => trim($dataKH[2], " ")], ['ten_kh' => trim($dataKH[0], " "), 'dia_chi' => trim($dataKH[1], " "), 'dien_thoai' => trim($dataKH[2], " ")]);
                $hd = hoa_don::create(['khach_hang_id' => $kh->id, 'tong_tien' => $request->manny, 'create_by' => 1]);
                foreach ($request->san_pham as $val) {
                    cthd::create(['hoa_don_id' => $hd->id, 'san_pham_id' => $val['id'], 'sl_mua' => $val['sl_mua']]);
                    $sp = san_pham::find($val['id']);
                    $sp->update(['so_luong' => ($sp->so_luong - $val['sl_mua'])]);
                }
            } else {
                $hd = hoa_don::create(['khach_hang_id' => $request->id_kh, 'tong_tien' => $request->manny, 'create_by' => 1]);
                foreach ($request->san_pham as $val) {
                    cthd::create(['hoa_don_id' => $hd->id, 'san_pham_id' => $val['id'], 'sl_mua' => $val['sl_mua']]);
                    $sp = san_pham::find($val['id']);
                    $sp->update(['so_luong' => ($sp->so_luong - $val['sl_mua'])]);
                }
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
        $san_pham = san_pham::where('so_luong', '>', 0)->get();
        $khach_hang = khach_hang::where('trang_thai', 0)->where('loai_kh', 1)->get();
        $hoa_don = hoa_don::findOrFail($id);
        return view('admin.giao_dich.edit', compact('hoa_don', 'khach_hang', 'san_pham'));
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
            $cthd = cthd::where('hoa_don_id', $id);
            foreach ($cthd->get() as $val) {
                $san_pham = san_pham::findOrFail($val->san_pham_id);
                $san_pham->update(['so_luong' => ($san_pham->so_luong + $val->sl_mua)]);
            }
            $cthd->delete();

            if (isset($request->text_kh)) {
                $dataKH = explode(",", $request->text_kh);
                $kh = khach_hang::updateOrCreate(['ten_kh' => trim($dataKH[0], " "), 'dien_thoai' => trim($dataKH[2], " ")], ['ten_kh' => trim($dataKH[0], " "), 'dia_chi' => trim($dataKH[1], " "), 'dien_thoai' => trim($dataKH[2], " ")]);
                hoa_don::findOrFail($id)->update(['khach_hang_id' => $kh->id, 'tong_tien' => $request->manny]);
                foreach ($request->san_pham as $val) {
                    cthd::create(['hoa_don_id' => $id, 'san_pham_id' => $val['id'], 'sl_mua' => $val['sl_mua']]);
                    $sp = san_pham::find($val['id']);
                    $sp->update(['so_luong' => ($sp->so_luong - $val['sl_mua'])]);
                }
            } else {
                hoa_don::findOrFail($id)->update(['khach_hang_id' => $request->id_kh, 'tong_tien' => $request->manny]);
                foreach ($request->san_pham as $val) {
                    cthd::create(['hoa_don_id' => $id, 'san_pham_id' => $val['id'], 'sl_mua' => $val['sl_mua']]);
                    $sp = san_pham::find($val['id']);
                    $sp->update(['so_luong' => ($sp->so_luong - $val['sl_mua'])]);
                }
            }

            return 1;
        } catch (\Exception $e) {
            return 0;
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
        $hd = hoa_don::find($id);
        if ($hd) {
            $cthd = cthd::where('hoa_don_id', $id);
            foreach ($cthd->get() as $val) {
                $san_pham = san_pham::findOrFail($val->san_pham_id);
                $san_pham->update(['so_luong' => ($san_pham->so_luong + $val->sl_mua)]);
            }
            $cthd->delete();
            $hd->delete();
            return redirect()->back()->with(['message' => "Xóa hóa đơn thành công!"]);
        } else
            return redirect()->back()->with(['error' => "Xóa hóa đơn thành công!"]);
    }
}
