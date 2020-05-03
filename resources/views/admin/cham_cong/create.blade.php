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
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <div class="callout-top callout-top-danger table-responsive">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <button class="btn btn-outline-primary" onclick="save()">Chấm công</button>
            </div>
        </div>
        <table align="center" width="100%"
               class="table table-hover table-striped table-bordered border text-center display">
            <thead>
            <tr class="bg-danger">
                <th>Mã nhân viên</th>
                <th>Tên đầy đủ</th>
                <th>Ngày công</th>
                <th>Số công</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $val)
                <tr>
                    <td>NV00{{$val->id}}</td>
                    <td class="text-left">{{($val->user)->name}}</td>
                    <td>{{$date['mday']}}/{{$date['mon']}}/{{$date['year']}}</td>
                    <td>
                        @php(
                        $arr = explode(',',$val->ngay_cong)
                        )
                        <select class="form-control" id="handle{{$val->id}}" onchange="getData({{$val->id}})">
                            <option @if(isset($arr[$date['mday']]) && $arr[$date['mday']] == 0) selected
                                    @endif value="0">0
                            </option>
                            <option @if(isset($arr[$date['mday']]) && $arr[$date['mday']] == 0.5) selected
                                    @endif value="0.5">0.5
                            </option>
                            <option @if(isset($arr[$date['mday']]) && $arr[$date['mday']] == 1) selected
                                    @endif value="1">1
                            </option>
                        </select>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row mt-2">
            <div class="col-12 text-center">
                <button class="btn btn-outline-primary" onclick="save()">Chấm công</button>
            </div>
        </div>
    </div>
    <script>
        var arr = [];

        function getData(id) {
            var value = $('#handle' + id).val();
            arr[id] = {id: id, value: value};
        }

        function save() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (arr.length <= 0) {
                alert("Vui lòng thực hiện chấm công!");
            } else {
                $.post('', {arr: arr.filter(v => (v != null))}, function (data) {
                    if (data == 1) {
                        alert("Đã chấm công!");
                        location.href = "/admin/cham_cong";
                    } else {
                        alert("Chấm công thất bại!");
                    }
                })
            }
        }
    </script>
@endsection
@stop