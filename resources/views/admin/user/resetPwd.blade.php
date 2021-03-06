@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.html"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">管理员修改密码</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">管理员修改密码</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">添加用户</div>
							<table class="formtable">
								<tr>
									<td align="right">老师电话</td>
									<td>
										<input id="name" name="name" type="text" value="admin" class="form-control">
									</td>
									<td align="right">原密码</td>
									<td>
										<input id="pass" name="pass" type="text" placeholder="密码" class="form-control">
									</td>
								</tr>
								<tr>
									<td align="right">新密码</td>
									<td>
										<input id="name" name="name" type="text" value="admin" class="form-control">
									</td>
									<td align="right">确定新密码</td>
									<td>
										<input id="pass" name="pass" type="text" placeholder="密码" class="form-control">
									</td>
									
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="button" class="btn btn-primary btn-sm">
										  <span class="glyphicon glyphicon-add" aria-hidden="true"></span>确定修改
										</button>
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