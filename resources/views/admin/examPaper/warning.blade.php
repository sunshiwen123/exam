@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <h2 class='color'>题目不可为空</h2>

	<a href="addEp" class="btn btn-info btn-sm">
	   <span class="glyphicon " aria-hidden="true"></span>返回添加题目
	</a>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop