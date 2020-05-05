@extends('layouts.app')

@section('main')
@section('title', 'Quản lý giao dịch')
@section('content_header')
    <h5 class="m-0">Thêm hóa đơn:</h5>
@stop
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <div class="callout-top callout-top-danger">
        <table align="center" class="text-right">
            <tbody id="data1">
            <tr>
                <td>Khách hàng:</td>
                <td style="width: 240px;text-align: left">
                    <div class="form-group m-0 khach_hang">
                        <select value="" class="form-control select2" name="id_kh" style="width: 100%;">
                            <option value="">-----------------Chọn---------------</option>
                            @foreach($khach_hang as $val)
                                <option value="{{$val->id}}"
                                        title="{{$val->ten_kh.",".$val->dia_chi.",".$val->email.",".$val->dien_thoai}}">
                                    {{$val->ten_kh}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="form-control khach_hang" name="text_kh" type="text"
                           placeholder="họ tên, địa chỉ, điện thoại"
                           style="display: none" value="">
                </td>
                <td>
                    <summary onclick="controlKH()" class="fas fa-sync-alt"></summary>
                </td>
            </tr>
            <tr>
                <td>Số sản phẩm:</td>
                <td id="sl_mua">0</td>
            </tr>
            <tr>
                <td>Tổng tiền:</td>
                <td id="tong_tien">0 vnđ</td>
            </tr>
            <tr>
                <td>Giảm giá:</td>
                <td id="sale">0 vnđ</td>
            </tr>
            <tr class="border-danger border-top">
                <td>Thành tiền:</td>
                <td id="thanh_tien">0 vnđ</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="pay()">Thanh toán</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="table-responsive" style="height: 300px">
            <table align="center" width="100%"
                   class="table table-head-fixed table-hover table-striped border-danger text-center">
                <thead>
                <tr>
                    <th class="bg-danger">STT</th>
                    <th class="bg-danger">Tên sản phẩm</th>
                    <th class="bg-danger">Số lượng mua</th>
                    <th class="bg-danger">Giảm giá</th>
                    <th class="bg-danger">Đơn giá</th>
                    <th class="bg-danger">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal">
                            +Thêm
                        </button>
                    </th>
                </tr>
                </thead>
                <tbody id="san_pham">
                {{--jQuery--}}
                </tbody>
            </table>
        </div>
    </div>
    <script>
        //
    </script>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                    <table id="data-table" class="table table-hover table-striped table-bordered text-center">
                        <thead>
                        <tr class="bg-danger">
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giảm giá</th>
                            <th>Đơn giá</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($san_pham as $val)
                            <tr>
                                <td>{{$val->ten_sp}}</td>
                                <td>{{$val->so_luong}}</td>
                                <td>{{$val->sale}}%</td>
                                <td>{{_manny($val->gia)}} vnđ</td>
                                <td>
                                    <button type="button" id="sp-{{$val->id}}" class="btn btn-sm btn-success"
                                            onclick="book({{$val}})">
                                        +Thêm
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        var san_pham = [];
                        var sale = 0;
                        var manny = 0;

                        function _manny(str) {
                            str = str.split('').reverse().join('');
                            var tg = "";
                            var i = 0;
                            for (i; i < str.length; i++) {
                                tg += str[i];
                                if (i !== str.length - 1 && (i + 1) % 3 === 0) {
                                    tg += '.';
                                }
                            }
                            return tg.split('').reverse().join('');
                        }

                        function printf() {
                            var str = "";
                            var i;
                            for (i = 0; i < san_pham.length; i++) {
                                manny += ((100 - san_pham[i].sale) * san_pham[i].gia / 100) * san_pham[i].sl_mua;
                                sale += ((san_pham[i].sale) * san_pham[i].gia / 100) * san_pham[i].sl_mua;
                                str += "<tr>\n" +
                                    "<td>" + (i + 1) + "</td>\n" +
                                    "<td class=\"text-left\">" + san_pham[i].ten_sp + "</td>\n" +
                                    "<td><input style=\"width: 50px;\" onchange=\"sl(" + san_pham[i].id + ")\" id='sl-" + san_pham[i].id + "' type=\"number\" value=\"" + san_pham[i].sl_mua + "\"></td>\n" +
                                    "<td>" + san_pham[i].sale + "%</td>\n" +
                                    "<td>" + _manny("" + (100 - san_pham[i].sale) * san_pham[i].gia / 100 * san_pham[i].sl_mua) + " vnđ</td>\n" +
                                    "<td>\n" +
                                    "    <button type=\"button\" onclick=\"del(" + san_pham[i].id + ")\" id='del-" + san_pham[i].id + "' class=\"btn btn-sm btn-danger\">Xóa</button>\n" +
                                    "</td>\n" +
                                    "</tr>";
                            }
                            $('#san_pham').html(str);
                            $('#sl_mua').html(san_pham.length);
                            $('#tong_tien').html(_manny("" + (manny + sale)) + " vnđ");
                            $('#sale').html(_manny("" + sale) + " vnđ");
                            $('#thanh_tien').html(_manny("" + manny) + " vnđ");
                        }

                        function book(obj) {
                            $('#sp-' + obj.id).hide();
                            san_pham.push({...obj, sl_mua: 1});
                            manny = 0;
                            sale = 0;
                            printf();
                        }

                        function pay() {
                            if ($('select[name="id_kh"]').val() === "" && $('input[name="text_kh"]').val() === "") {
                                alert("Vui lòng nhập khách hàng?");
                            } else if (san_pham.length === 0) {
                                alert("Vui lòng chọn sản phẩm?")
                            }
                            else {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.post('', {
                                    manny: manny,
                                    san_pham: san_pham,
                                    id_kh: $('select[name="id_kh"]').val(),
                                    text_kh: $('input[name="text_kh"]').val(),
                                }, function (data) {
                                    if (data == 1) {
                                        alert("Giao dịch thành công!");
                                        location.href = "/admin/giao_dich";
                                    } else {
                                        alert("Giao dịch không thành công!")
                                    }
                                });
                            }
                        }

                        function sl(id) {
                            san_pham = san_pham.map(v => (v.id === id ? {
                                ...v, sl_mua: controlSl(v.so_luong, $('#sl-' + id).val())
                            } : v));
                            manny = 0;
                            sale = 0;
                            printf();
                        }

                        function controlSl(oldNum, newNum) {
                            if (newNum < 0)
                                return 1;
                            if (newNum > oldNum) {
                                alert("Kho không đủ số lượng!");
                                return oldNum;
                            }
                            return newNum;
                        }

                        function controlKH() {
                            $('.khach_hang').toggle();
                            $('input[name="text_kh"]').val(null);
                        }

                        function del(id) {
                            $('#sp-' + id).show();
                            manny = 0;
                            sale = 0;
                            san_pham = san_pham.filter(v => v.id !== id);
                            printf();
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@stop
@endsection