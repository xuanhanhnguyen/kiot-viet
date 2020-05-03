@extends('layouts.app')

@section('main')
@section('title', 'Quản lý nhân viên')
@section('content_header')
    <h5 class="m-0">Bảng công nhân viên:</h5>
@stop
@section('content')
    @php(
    $date = getdate()
    )
    @php(
        $nam = $date['year']
    )
    @php(
        $thang = $date['mon']
    )
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

    <div class="callout-top callout-top-danger table-responsive">
        <div class="row">
            <div class="form-group mt-2 d-flex align-items-center col-md-2">
                <label>Năm:</label>
                <select name="nam" class="form-control text-center">
                    <option value="{{$nam}}">{{$nam}}</option>
                    <option value="{{$nam-1}}">{{$nam-1}}</option>
                    <option value="{{$nam-2}}">{{$nam-2}}</option>
                    <option value="{{$nam-3}}">{{$nam-3}}</option>
                </select>
            </div>

            <div class="form-group d-flex align-items-center col-md-2 mt-2">
                <label>Tháng:</label>
                <select name="thang" class="form-control text-center">
                    <option @if($thang === 1) selected @endif value="1">1</option>
                    <option @if($thang === 2) selected @endif value="2">2</option>
                    <option @if($thang === 3) selected @endif value="3">3</option>
                    <option @if($thang === 4) selected @endif value="4">4</option>
                    <option @if($thang === 5) selected @endif value="5">5</option>
                    <option @if($thang === 6) selected @endif value="6">6</option>
                    <option @if($thang === 7) selected @endif value="7">7</option>
                    <option @if($thang === 8) selected @endif value="8">8</option>
                    <option @if($thang === 9) selected @endif value="9">9</option>
                    <option @if($thang === 10) selected @endif value="9">10</option>
                    <option @if($thang === 11) selected @endif value="10">11</option>
                    <option @if($thang === 12) selected @endif value="11">12</option>

                </select>
            </div>
            <div class="form-group col mt-2">
                <button class="btn btn-outline-primary" onclick="show()">lọc</button>
                <button class="btn btn-outline-danger" onclick="location.href = 'cham_cong/create'">Chấm công</button>
            </div>
        </div>
        <hr width="100%" class="mt-0">
        <table id="data-table" align="center" width="100%"
               class="table table-hover table-striped table-bordered border text-center display">
            <thead>
            <tr class="bg-danger">
                <th>Mã nhân viên</th>
                <th>Tên đầy đủ</th>
                <th>Số ngày công</th>
            </tr>
            </thead>
            <tbody id="data">
            @foreach($data as $val)
                <tr>
                    <td onclick="getModal({{$val}})">NV00{{$val->id}}</td>
                    <td class="text-left">{{$val->user->name}}</td>
                    <td class="text-center">
                        @php(
                            $tg = 0
                        )

                        @foreach(explode(',',$val->ngay_cong) as $val)
                            @php(
                                $tg += $val
                            )
                        @endforeach
                        {{$tg}}
                    </td>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" id="detail">
                </div>
            </div>
        </div>
    </div>
    <script>
        function show() {
            var nam = $('select[name="nam"]').val();
            var thang = $('select[name="thang"]').val();
            var str = "";
            var i = 0;
            var j = 0;

            $.get('cham_cong/' + thang + '/' + nam, function (data) {
                for (i = 0; i < data.length; i++) {
                    var tg = 0;
                    var cong = data[i].ngay_cong.split(',');
                    for (j = 0; j < cong.length; j++) {
                        tg += Number(cong[j]);
                    }
                    str += "<tr>\n" +
                        "<td>NV00" + data[i].user_id + "</td>\n" +
                        "<td class=\"text-left\">" + data[i].user.name + "</td>\n" +
                        "<td class=\"text-left\">" + tg + "</td>\n" +
                        "</tr>";
                }
                $('#data').html(str);
            });
        }

        function getModal(obj) {
            var arr = (obj.ngay_cong).split(",");
            var th = "<tr><th colspan='" + (arr.length + 1) + "' class='text-center'>(" + obj.user.name + ")Chi tiết công tháng " + obj.thang + "-" + obj.nam + "</th></tr>";
            var day = "<td><b>Ngày</b></td>";
            var cong = "<td><b>Số công</b></td>";
            for (var i = 0; i < arr.length; i++) {
                day += "<td>" + (i + 1) + "</td>";
                cong += "<td>" + arr[i] + "</td>";
            }
            var td = "<tr> " + day + "</tr><tr> " + cong + "</tr>";
            var detail = "<table class=\"table table-striped table-bordered border text-center display\">" + th + td + "</table>";
            console.log(detail);

            $('#detail').html(detail);
            $('#modal').modal('show');
        }
    </script>
@endsection
@stop