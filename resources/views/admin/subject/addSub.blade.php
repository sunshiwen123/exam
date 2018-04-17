@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.html"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">题库管理</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">添加科目</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-lg-8">
						 <form class="form-horizontal" action="/addSub" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							 <table class="formtable">
							 	<tr>
							 		 <td align="right">科目名称：</td>
							 		 <td><input id="name" name="sub_title" type="text" placeholder="科目名称" class="form-control"></td>
							 	</tr>
							 	<tr>
							 		 <td></td>
							 		 <td>
							 		 	<button type="submit" class="btn btn-primary btn-lg">
							 		 		<span class="glyphicon glyphicon-plus"></span>添加科目
							 		 	</button>
							 		 </td>
							 	</tr>
							 </table>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


