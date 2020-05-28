@extends('layouts.app')

@section('main')
@section('title', 'Quản lý nhân viên')
@section('content_header')
    <h5 class="m-0">Danh sách cửa hàng:</h5>
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
                <th>STT</th>
                <th>Tên cửa hàng</th>
                <th>Địa chỉ</th>
                <th style="width: 150px;">Hình ảnh</th>
                <th>
                    <button class="btn btn-success btn-sm" onclick="location.href = '/admin/cua_hang/create'">+Thêm
                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($store as $key=>$val)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$val->ten}}</td>
                    <td>{{$val->dia_chi}}</td>
                    <td>
                        <img style="width: 150px" src="/img/{{$val->hinh_anh}}" alt="ảnh">
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"
                        onclick="location.href = '/admin/cua_hang/{{$val->id}}'">
                            Cập nhật
                        </button>
                        <button class="btn btn-sm btn-outline-danger"
                        onclick="confirm('Đồng ý xóa?') ? location.href = '/admin/cua_hang/delete/{{$val->id}}': '';">
                            Xóa
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@stop