@extends('layouts.app')

@section('main')
@section('title', 'Admin || Thêm mới Khách hàng')

@section('content_header')
    <div class="row">        
        <h1>Thêm mới khách hàng</h1>        
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
    <form method="post" action="{{route('admin.customer.add')}}" enctype="multipart/form-data" accept-charset="UTF-8">
            {{ csrf_field()}}  
        <div class="form-group">
            <label for="exampleInputEmail1">Tên khách hàng:</label>
            <input type="text" name="ten_kh" class="form-control" required="true">    
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Địa chỉ:</label>
            <input type="text" name="dia_chi" class="form-control" required="true">
        </div>     
        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input type="text" name="email" class="form-control" required="true">    
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Số điện thoại:</label>
            <input type="text" name="dien_thoai" class="form-control" required="true">    
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div>


@stop
@stop
