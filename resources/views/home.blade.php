@extends('layouts.app')

@section('main')
@section('title', 'Quản lý cửa hàng')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="callout-top callout-top-danger">
        <table id="data-table" align="center" width="100%"
               class="table table-hover table-striped table-bordered border text-center display">
            <thead>
            <tr class="bg-danger">
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
            </tr>
            <tr>
                <td>Row 2 Data 1</td>
                <td>Row 2 Data 2</td>
            </tr>
            </tbody>
        </table>
    </div>
    <p>Welcome to this beautiful admin panel.</p>
    <textarea name="content" type="text" class="form-control ckeditor" rows="10"></textarea>
@stop
@endsection