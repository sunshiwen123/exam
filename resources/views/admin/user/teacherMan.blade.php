@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.html"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">系统设置</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">老师管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<a href="addTeacher" class="btn btn-danger">
					添加老师
				</a>
				<div class="panel panel-default mt2">
					<div class="panel-body">
							
							<table class="formtable">
								<tr>
									<td>老师名称</td>
									<td>编辑</td>
								</tr>
								<tr>
									<td>admin</td>
									<td>
									<a href="sys_add.html" class="btn btn-success">
									  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 编辑
									</a>
									<a href="sys_add.html" class="btn btn-info">
									  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 删除该用户
									</a>
									</td>
								</tr>
								<tr>
									<td>3stones</td>
									<td>
									<a href="sys_add.html" class="btn btn-success">
									  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 编辑
									</a>
									<a href="sys_add.html" class="btn btn-info">
									  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 删除该用户
									</a>
									</td>
								</tr>
							</table>
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