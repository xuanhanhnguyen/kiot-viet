@extends('layouts.app')

@section('main')
@section('title', 'Đổi mật khẩu')
@section('content_header')
    {{--<h5 class="m-0">Danh sách nhân viên:</h5>--}}
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
    <div class="row">
        <div class="col-4"></div>
        <div class="callout-top callout-top-danger text-center col-4">
            <form action="{{route('nhan_vien.update',$id)}}" method="POST">
                @csrf
                <div class="form-group mt-2">
                    <label for="password">Mật khẩu mới:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group mt-2">
                    <label for="password_config">Nhập lại mật khẩu:</label>
                    <input type="password" name="password_config" class="form-control" required>
                </div>
                <button class="btn btn-sm btn-outline-danger" type="submit">Đổi mật khẩu?</button>
            </form>
        </div>
        <div class="col-4"></div>
    </div>
@endsection
@stop