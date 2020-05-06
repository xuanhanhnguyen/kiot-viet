@extends('layouts.app')

@section('main')
@section('title', 'Quản lý nhân viên')
@section('content_header')
    <h5 class="m-0">Danh sách nhân viên:</h5>
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
                <th>Mã nhân viên</th>
                <th>Tên đầy đủ</th>
                <th>Email</th>
                <th>Thông tin</th>
                <th>Trạng thái</th>
                <th>
                    <button class="btn btn-success btn-sm" onclick="location.href = '/admin/nhan_vien/insert'">+Thêm
                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($user as $val)
                <tr>
                    <td>NV00{{$val->id}}</td>
                    <td class="text-left">{{$val->name}}</td>
                    <td class="text-left">{{$val->email}}</td>
                    <td class="text-left">
                        Điện thoại: {{$val->dien_thoai}}<br/>
                        Ngày sinh: {{$val->ngay_sinh}}<br/>
                        Địa chỉ: {{$val->dia_chi}}<br/>
                        Chức vụ: {{($val->chuc_vu === 1 ? 'Admin': $val->chuc_vu) ===  2 ? 'Kế toán': "Nhân viên"}}<br/>
                    </td>
                    <td>
                        <form action="{{route('nhan_vien.update', $val->id)}}" method="POST">
                            @csrf
                            <input class="d-none" type="number" value="{{$val->trang_thai === 1 ? 0:1}}"
                                   name="trang_thai">
                            @if($val->trang_thai === 1)
                                <button class="btn btn-sm btn-outline-success"
                                        @if($val->chuc_vu == 1) disabled @endif type="submit">Hoạt động
                                </button>
                            @else
                                <button class="btn btn-sm btn-outline-danger" @if($val->chuc_vu == 1) disabled @endif type="submit">Ẩn
                                </button>
                            @endif
                        </form>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="location.href = 'nhan_vien/{{$val->id}}/edit'">
                            Cập nhật
                        </button>
                        <button class="btn btn-sm btn-outline-danger"
                                onclick="confirm('Đồng ý xóa?') ? location.href = 'nhan_vien/{{$val->id}}/delete': '';">
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