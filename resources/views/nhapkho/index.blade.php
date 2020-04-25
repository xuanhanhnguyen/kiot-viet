@extends('layouts.app')
@section('main')
@section('title', 'Admin || Quản lý nhập kho')

@section('content_header')
    <div class="row">
        <div class="col-md-3">
            <h1>Quản lý nhập kho</h1>
        </div>
        <div class="col-md-2">
        <a href="{{route('admin.kho.goadd')}}" class="btn btn-success" style="color:#fff;">Thêm mới</a>
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
      <th scope="col">Khách hàng</th>
      <th scope="col">Sản phẩm</th>
      <th scope="col">Số lượng</th>     
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
  @foreach($nhapkho as $key=>$nhap)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$nhap->ten_kh}}</td>
      <td>{{$nhap->ten_sp}}</td>    
      <td>{{$nhap->sl_nhap}}</td>           
      <td>
        <a href="{{route('admin.kho.goedit',$nhap->idkho)}}" style="color:#fff;"  class="btn btn-info">Cập nhật</a>
        <a href="{{route('admin.kho.delete',$nhap->idkho)}}" class="btn btn-danger" style="color:#fff;">Xóa</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@stop
@stop
