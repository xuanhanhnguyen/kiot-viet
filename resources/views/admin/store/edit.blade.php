@extends('layouts.app')

@section('main')
@section('title', 'Quản lý giao dịch')
@section('content_header')
    <h5 class="m-0"><a href="#" onclick="window.history.back();">Dang sách cửa hàng</a>/Cập nhật cửa hàng</h5>
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
        <form action="/admin/cua_hang/{{$store->id}}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
            @method('PUT')
            @csrf
            <div class="form-group mt-2">
                <label>Tên cửa hàng</label>
                <input type="text" name="ten" value="{{$store->ten}}" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label for="cat">Địa chỉ</label>
                <input type="text" name="dia_chi" value="{{$store->dia_chi}}" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label for="cat">Hình ảnh:</label>
                <input type="file" name="hinh_anh" class="form-control">
            </div>
            <img src="/img/{{$store->hinh_anh}}" style="width: 100px" alt="">
            <div class="text-center">
                <button class="btn btn-sm btn-outline-warning" type="submit">Cập nhật </button>
            </div>
        </form>
    </div>
@endsection
@stop