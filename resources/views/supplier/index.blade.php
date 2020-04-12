@extends('layouts.app')
@section('main')
@section('title', 'Admin || Quản lý Nhà cung cấp')

@section('content_header')
    <div class="row">
        <div class="col-md-3">
            <h1>Quản lý Nhà cung cấp</h1>
        </div>
        <div class="col-md-2">
        <a href="{{route('admin.supplier.goadd')}}" class="btn btn-success" style="color:#fff;">Thêm mới</a>
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
<table id="customer" align="center" width="100%" class="table table-hover table-striped table-bordered border text-center display">
  <thead>
    <tr class="bg-danger">
      <th scope="col">STT</th>
      <th scope="col">Tên khách hàng</th>
      <th scope="col">Địa chỉ</th>
      <th scope="col">Email</th>
      <th scope="col">Số điện thoại</th>           
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
  @foreach($customers as $key=>$customer)
    <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$customer->ten_kh}}</td>
      <td>{{$customer->dia_chi}}</td>     
      <td>{{$customer->email}}</td>
      <td>{{$customer->dien_thoai}}</td>                
      <td>
        <a href="{{route('admin.supplier.goedit',$customer->id)}}" style="color:#fff;"  class="btn btn-info">Cập nhật</a>
        <a href="{{route('admin.supplier.delete',$customer->id)}}" class="btn btn-danger" style="color:#fff;">Xóa</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@stop
@stop
