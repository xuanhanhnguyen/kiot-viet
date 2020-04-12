@extends('layouts.app')
@section('main')
@section('title', 'Admin || Quản lý sản phẩm')

@section('content_header')
    <div class="row">
        <div class="col-md-3">
            <h1>Quản lý sản phẩm</h1>
        </div>
        <div class="col-md-2">
        <a href="{{route('admin.product.goadd')}}" class="btn btn-success" style="color:#fff;">Thêm mới</a>
        </div>
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
<div class="callout-top callout-top-danger">
<table id="product" align="center" width="100%" class="table table-hover table-striped table-bordered border text-center display">
  <thead>
    <tr class="bg-danger">
      <th scope="col">STT</th>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Giá</th>
      <th scope="col">Khuyến mãi</th>    
      <th scope="col">Mô tả</th>    
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
  @foreach($products as $key=>$product)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$product->ten_sp}}</td>
      <td>{{$product->so_luong}}</td>
      <td>        
        <img src="{{ URL::to('/') }}/img/{{$product->hinh_anh}}" width="50" alt="Image"/>
      </td>
      <td>{{$product->gia}}</td>
      <td>{{$product->sale}}</td>    
      <td>{{$product->mo_ta}}</td>         
      <td>
        <a href="{{route('admin.product.goedit',$product->id)}}" style="color:#fff;"  class="btn btn-info">Cập nhật</a>
        <a href="{{route('admin.product.delete',$product->id)}}" class="btn btn-danger" style="color:#fff;">Xóa</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@stop
@stop
