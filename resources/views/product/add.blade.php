@extends('layouts.app')

@section('main')
@section('title', 'Admin || Thêm mới sản phẩm')

@section('content_header')
    <div class="row">        
        <h1>Thêm mới sản phẩm</h1>        
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
    <form method="post" action="{{route('admin.product.add')}}" enctype="multipart/form-data" accept-charset="UTF-8">
            {{ csrf_field()}}  
        <div class="form-group">
            <label for="exampleInputEmail1">Tên sản phẩm:</label>
            <input type="text" name="ten_sp" class="form-control" required="true">    
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Số lượng:</label>
            <input type="number" name="so_luong" class="form-control" required="true">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Hình ảnh:</label>
            <input type="file" name="hinh_anh" class="form-control" required="true">    
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Giá:</label>
            <input type="text" name="gia" class="form-control" required="true">    
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Khuyến mãi:</label>
            <input type="number" name="sale" class="form-control" required="true">    
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mô tả:</label>
            <input type="text" name="mo_ta" class="form-control" required="true">    
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div>


@stop
@stop
