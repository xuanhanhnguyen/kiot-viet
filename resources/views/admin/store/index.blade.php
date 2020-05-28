@extends('layouts.app')

@section('main')
@section('title', 'Quản lý xe máy')
{{--@section('content_header')--}}
{{--@stop--}}
@section('content')
    <div class="opacity"></div>
    <div class="callout-top callout-top-danger store">
        <h5>Danh sách cửa hàng:</h5>
        <div class="row">
            @foreach($stores as $store)
                <div class="col-md-4 m-2 p-0 border">
                    <a href="/admin/{{$store->id}}/home">
                        <div style="height: 200px;">
                            <img class="w-100 h-100" src="/img/{{$store->hinh_anh}}" alt="Ảnh">
                        </div>
                        <div class="text-center">
                            <h5>{{$store->ten}}</h5>
                            <p>{{$store->dia_chi}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        aside {
            pointer-events: none;
        }

        .opacity {
            position: absolute;
            opacity: 0.4;
            pointer-events: none;
            z-index: 999999;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: black;
        }

        .store {
            position: absolute;
            opacity: 1;
            pointer-events: auto;
            z-index: 9999999;
            width: 90%;
            top: 5%;
            left: 5%;
            height: 90%;
            overflow-y: auto;
            margin: 0 auto;
        }
    </style>
@endsection