@extends('adminlte::page')

@yield('main')

@section('css')
    <link rel="stylesheet" href="/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('#data-table').DataTable(
                {
                    "oLanguage": {
                        "sProcessing": "Đang xử lý...",
                        "sLengthMenu": "Xem _MENU_ mục",
                        "sZeroRecords": "không có dữ liệu",
                        "sInfo": "_TOTAL_ mục",
                        "sInfoEmpty": "0 mục",
                        "sInfoFiltered": "",
                        "sInfoPostFix": "",
                        "sSearch": "Tìm kiếm:",
                        "sUrl": "",
                        "oPaginate": {
                            "sPrevious": "<",
                            "sNext": ">",
                        }
                    }
                }
            );
            $('#product').DataTable(
                {
                    "oLanguage": {
                        "sProcessing": "Đang xử lý...",
                        "sLengthMenu": "Xem _MENU_ mục",
                        "sZeroRecords": "không có dữ liệu",
                        "sInfo": "_TOTAL_ mục",
                        "sInfoEmpty": "0 mục",
                        "sInfoFiltered": "",
                        "sInfoPostFix": "",
                        "sSearch": "Tìm:",
                        "sUrl": "",
                        "oPaginate": {
                            "sPrevious": "<",
                            "sNext": ">",
                        }
                    }
                }
            );
            $('#customer').DataTable(
                {
                    "oLanguage": {
                        "sProcessing": "Đang xử lý...",
                        "sLengthMenu": "Xem _MENU_ mục",
                        "sZeroRecords": "không có dữ liệu",
                        "sInfo": "_TOTAL_ mục",
                        "sInfoEmpty": "0 mục",
                        "sInfoFiltered": "",
                        "sInfoPostFix": "",
                        "sSearch": "Tìm:",
                        "sUrl": "",
                        "oPaginate": {
                            "sPrevious": "<",
                            "sNext": ">",
                        }
                    }
                }
            );
        });
    </script>
    <!-- page script -->
    <script type="text/javascript" language="javascript" src="/ckeditor/ckeditor.js"></script>
    @yield('jquery')
@stop