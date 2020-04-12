@extends('layouts.app')

@section('main')
@section('title', 'Admin || Cập nhật Nhà cung cấp')

@section('content_header')
    <div class="row">        
        <h1>Cập nhật Nhà cung cấp</h1>        
    </div>    

@stop

@section('content')
@if(session()->has('message'))
<div class="row">
    <div class="col-md-4">
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    </div>    
</div>
@endif
<div class="row">
    <div class="col-md-6 callout-top callout-top-danger pt-0">
        @foreach($customers as $customer)
        <form method="post" action="{{route('admin.supplier.edit',$customer->id)}}" enctype="multipart/form-data" accept-charset="UTF-8">
            {{ csrf_field()}}
            <div class="form-group">
            <label for="exampleInputEmail1">Tên khách hàng:</label>
            <input type="text" name="ten_kh" class="form-control" value="{{$customer->ten_kh}}" required="true">    
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Địa chỉ:</label>
            <input type="text" name="dia_chi" class="form-control" value="{{$customer->dia_chi}}" required="true">
        </div>     
        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input type="text" name="email" class="form-control" value="{{$customer->email}}" required="true">    
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Số điện thoại:</label>
            <input type="text" name="dien_thoai" class="form-control" value="{{$customer->dien_thoai}}" required="true">    
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
        @endforeach
    </div>
</div>
@stop

@stop
