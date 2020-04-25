@extends('layouts.app')

@section('main')
@section('title', 'Quản lý giao dịch')
@section('content_header')
    <h5 class="m-0">Danh sách hóa đơn:</h5>
@stop
@section('content')

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo</h4>
            {{ session('message') }}
        </div>
    @endif
    <div class="callout-top callout-top-danger">
        <table id="data-table" align="center" width="100%"
               class="table table-hover table-striped table-bordered border text-center display">
            <thead>
            <tr class="bg-danger">
                <th>Mã hóa đơn</th>
                <th>Người tạo</th>
                <th>Thời gian</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>
                    <button class="btn btn-success btn-sm" onclick="location.href = '/admin/giao_dich/them'">+Thêm
                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($hoa_don as $val)
                <tr>
                    <td onclick="detailt({{$val->id}})">HD00{{$val->id}}</td>
                    <td onclick="detailt({{$val->id}})">{{($val->user)->name}}</td>
                    <td onclick="detailt({{$val->id}})">{{$val->created_at}}</td>
                    <td onclick="detailt({{$val->id}})">{{($val->khach_hang)->ten_kh}}</td>
                    <td onclick="detailt({{$val->id}})">{{_manny($val->tong_tien)}} vnđ</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary">Cập nhật</button>
                        <button class="btn btn-sm btn-outline-danger">
                            <a class="text-dark" href="{{route('giao_dich.delete', $val->id)}}"
                               onclick="return confirm('Bạn muốn xóa hóa đơn này?');">Xóa</a>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <style>
            td:hover {
                cursor: pointer;
            }
        </style>
        <script>
            function dateTime(str) {
                if (str === null)
                    return "-";
                else {
                    str = str.substring(0, 10) + " " + str.substring(11, 19);
                    return str;
                }
            }

            function _manny(str) {
                str = str.split('').reverse().join('');
                var tg = "";
                var i = 0;
                for (i; i < str.length; i++) {
                    tg += str[i];
                    if (i !== str.length - 1 && (i + 1) % 3 === 0) {
                        tg += ',';
                    }
                }
                return tg.split('').reverse().join('');
            }

            function detailt(id) {
                $.get('giao_dich/' + id, function (data) {
                    var i;
                    var str = "";
                    var sl = 0;
                    var sum = 0;
                    var manny = 0;
                    for (i = 0; i < (data.cthd).length; i++) {
                        sl += data.cthd[i].sl_mua;
                        sum += (data.cthd[i].san_pham).gia * data.cthd[i].sl_mua;
                        manny += ((data.cthd[i].san_pham).gia * (100 - (data.cthd[i].san_pham).sale) / 100) * data.cthd[i].sl_mua;
                        console.log(manny);

                        str += "<tr>\n" +
                            "<td>" + (i + 1) + "</td>\n" +
                            "<td>" + (data.cthd[i].san_pham).ten_sp + "</td>\n" +
                            "<td>" + data.cthd[i].sl_mua + "</td>\n" +
                            "<td>" + (data.cthd[i].san_pham).sale + "%</td>\n" +
                            "<td>" + _manny("" + manny) + " vnđ</td>\n" +
                            "<td>" + dateTime(data.cthd[i].created_at) + "</td>\n" +
                            "</tr>";
                    }
                    $('#data').html(str);

                    str = "<tr>\n" +
                        "    <td><strong>Mã hóa đơn:</strong></td>\n" +
                        "    <td>HD00" + data.hoa_don.id + "</td>\n" +
                        "</tr>\n" +
                        "<tr>\n" +
                        "    <td><strong>Khách hàng:</strong></td>\n" +
                        "    <td>" + data.hoa_don.khach_hang.ten_kh + "</td>\n" +
                        "</tr>\n" +
                        "<tr>\n" +
                        "    <td><strong>Tổng số lượng:</strong></td>\n" +
                        "    <td>" + sl + "</td>\n" +
                        "</tr>\n" +
                        "<tr>\n" +
                        "    <td><strong>Tổng tiền:</strong></td>\n" +
                        "    <td>" + _manny("" + sum) + " vnđ</td>\n" +
                        "</tr>\n" +
                        "<tr>\n" +
                        "    <td><strong>Giảm giá:</strong></td>\n" +
                        "    <td>" + _manny("" + (sum - manny)) + " vnđ</td>\n" +
                        "</tr>\n" +
                        "<tr class=\"border-top border-danger\">\n" +
                        "    <td><strong>Thành tiền:</strong></td>\n" +
                        "    <td>" + _manny("" + manny) + " vnđ</td>\n" +
                        "</tr>";
                    $('#data1').html(str);
                    $('.modal').modal('show');
                });
            }
        </script>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h6 class="modal-title">Chi tiết đơn hàng:</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-hover table-striped table-bordered text-center">
                        <thead>
                        <tr class="bg-danger">
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng mua</th>
                            <th>Giảm giá</th>
                            <th>Đơn giá</th>
                            <th>Thời gian</th>
                        </tr>
                        </thead>
                        <tbody id="data">

                        </tbody>
                    </table>
                    <table align="right" class="text-right">
                        <tbody id="data1">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@endsection