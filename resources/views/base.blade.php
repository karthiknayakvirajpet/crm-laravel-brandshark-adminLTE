@extends('adminlte::page')

@section('title', 'CRM Laravel')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>

    <!-- https://datatables.net -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> -->

    <!-- Bootstrap Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
<script>
$(document).ready(function(){
    //Time out for flash message
    setTimeout(function(){
       $("div.alert.alert-success").remove();
    }, 5000 ); // 8 secs
});
</script>
@stop