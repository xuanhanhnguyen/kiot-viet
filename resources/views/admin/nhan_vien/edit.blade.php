@extends('layouts.app')

@section('main')
@section('title', 'Quản lý nhân viên')
@section('content_header')
    <h5 class="m-0"><a href="#" onclick="window.history.back();">Dang sách nhân viên</a>/Thêm nhân viên</h5>
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

    <div class="callout-top callout-top-danger">
        <form action="" method="POST">
            @csrf
            <div class="form-group mt-2">
                <label>Họ & tên:</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label for="cat">Tài khoản:</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control" required>
            </div>
            <div class="row">
                <div class="form-group col-md-4 mt-2">
                    <label for="cat">Điện thoại:</label>
                    <input type="text" name="dien_thoai" value="{{$user->dien_thoai}}" class="form-control" required>
                </div>
                <div class="form-group col-md-4 mt-2">
                    <label for="cat">Ngày sinh:</label>
                    <input type="date" name="ngay_sinh" value="{{$user->ngay_sinh}}" class="form-control" required>
                </div>
                <div class="form-group col-md-4 mt-2">
                    <label for="cat">Chức vụ:</label>
                    <select class="form-control" name="chuc_vu" required>
                        <option @if($user->chuc_vu === 1 ) selected @endif value="1">Admin</option>
                        <option @if($user->chuc_vu === 2 ) selected @endif value="2">Kế toán</option>
                        <option @if($user->chuc_vu === 3 ) selected @endif value="3">Nhân viên</option>
                    </select>
                </div>
            </div>
            <div class="form-group mt-2">
                <label for="cat">Địa chỉ:</label>
                <input type="text" name="dia_chi" class="form-control" value="{{$user->dia_chi}}" required>
            </div>
            <div class="text-center">
                <button class="btn btn-sm btn-outline-danger" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
@stop