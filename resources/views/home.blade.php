@extends('layouts.app')

@section('main')
@section('title', 'Quản lý cửa hàng')

@section('content_header')
    <h1>Chào mừng bạn đến với trang quản lý</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div id="container" data-order="{{ $orderYear }}"></div>
        </div>
        <div class="col-md-6">
            <div id="container1" data-order="{{ $orderYear1 }}"></div>
        </div>
    </div>    
    <br><br>
    <h3>Những sản phẩm bán chạy</h3>
    <br>
    <div class="callout-top callout-top-danger">
        <table id="data-table" align="center" width="100%"
               class="table table-hover table-striped table-bordered border text-center display">
            <thead>
            <tr class="bg-danger">
                <th scope="col">STT</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Khuyến mãi</th>    
                <th scope="col">Mô tả</th> 
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
            </tr>  
            @endforeach         
            </tbody>
        </table>
    </div>      
@stop
@section('js')
    <script type="text/javascript" language="javascript" src="{{ asset('js/jquery-3.1.1.min.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('js/highcharts.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('js/modules/exporting.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('js/export-data.js')}}"></script>
    <script>
        $(document).ready(function(){
    var order = $('#container').data('order');
    var listOfValue = [];
    var listOfYear = [];
    order.forEach(function(element){
        listOfYear.push(element.getMonth);
        listOfValue.push(element.value);
    });
    console.log(listOfYear);
    console.log(listOfValue);
    var chart = Highcharts.chart('container', {

        title: {
            text: 'Thống kế Hóa đơn theo Tháng'
        },

        subtitle: {
            text: 'Plain'
        },

        xAxis: {
            categories: listOfYear,
        },

        series: [{
            type: 'column',
            colorByPoint: true,
            data: listOfValue,
            showInLegend: false
        }]
    });
    
    $('#plain').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: 'Plain'
            }
        });
    });

    $('#inverted').click(function () {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },
            subtitle: {
                text: 'Inverted'
            }
        });
    });

    $('#polar').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },
            subtitle: {
                text: 'Polar'
            }
        });
    });
});


$(document).ready(function(){
    var productBuy = $('#container1').data('order');
    var chartData = [];
    productBuy.forEach(function(element){
        var ele = {name : element.getMonth, y : parseFloat(element.value) };
        chartData.push(ele);
    });
    console.log(chartData);
    Highcharts.chart('container1', {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: 'Thống kê số khách hàng theo tháng'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: false
            },
            showInLegend: true
          }
        },
        series: [{
          name: 'Brands',
          colorByPoint: true,
          data: chartData,
        }]
    });    
});
    </script>
@stop
@endsection