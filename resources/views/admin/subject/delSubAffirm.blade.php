@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@stop

@section('content')
	@if( !empty($qcs))
	<h3 color='red'>此科目下还有分类，无法删除</h3>
	<br>
	<a href="/" class="btn btn-info btn-sm">
	   <span class="glyphicon " aria-hidden="true"></span>返回
	</a>
	@else
    <a href="/" class="btn btn-info btn-sm">
	   <span class="glyphicon " aria-hidden="true"></span>点错了
	</a>

	<a href="delSub?subId={{$data['subId']}}" class="btn btn-info btn-sm">
	   <span class="glyphicon " aria-hidden="true"></span>确认删除？
	</a>
	@endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop