@extends('layouts.app')

@section('main')
@section('title', 'Admin || Cập nhật sản phẩm')

@section('content_header')
    <div class="row">        
        <h1>Cập nhật Sản phẩm</h1>        
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
        
        <form method="post" action="{{route('admin.kho.edit',$nhapkho->id)}}" enctype="multipart/form-data" accept-charset="UTF-8">
            {{ csrf_field()}}
            <div class="form-group">
            <label for="exampleInputEmail1">Khách hàng:</label>
            <select class="form-control"  name="khach_hang_id" >
            @foreach($khachhang as $key=>$khach)
                <option value="{{$khach->id}}" {{ $khach->id == $nhapkho->khach_hang_id ? 'selected' : '' }}>[{{$khach->id}}]{{$khach->ten_kh}}</option>
            @endforeach
            </select>  
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Số lượng:</label>
            <select class="form-control" name="san_pham_id" id="type" name="quantity">
            @foreach($sanpham as $key=>$san)
                <option value="{{$san->id}}" {{ $san->id == $nhapkho->san_pham_id ? 'selected' : '' }}>[{{$san->id}}]{{$san->ten_sp}}</option>
            @endforeach
            </select> 
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Số lượng:</label>
            <input type="text" name="sl_nhap" class="form-control" required="true" value="{{$nhapkho->sl_nhap}}">    
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    
    </div>
</div>
@stop

@stop
