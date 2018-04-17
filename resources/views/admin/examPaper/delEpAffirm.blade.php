@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@stop

@section('content')
    <a href="examPaperList" class="btn btn-info btn-sm">
	   <span class="glyphicon " aria-hidden="true"></span>点错了
	</a>

	<a href="delEp?epId={{$epId}}" class="btn btn-info btn-sm">
	   <span class="glyphicon " aria-hidden="true"></span>确认删除？
	</a>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop