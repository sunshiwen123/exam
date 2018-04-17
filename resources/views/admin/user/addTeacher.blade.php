@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.html"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">老师管理</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">老师管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">添加用户</div>
						<form role="form" action="addTeacherSubmit" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<table class="formtable">
								<tr>
									<td align="right">老师名称</td>
									<td>
										<input id="name" name="userName" type="text" placeholder="用户名" class="form-control">
									</td>
									<td align="right">老师电话</td>
									<td>
										<input id="name" name="userTel" type="text" placeholder="电话" class="form-control">
									</td>
									<td align="right">登录密码</td>
									<td>
										<input id="pass" name="userPwd" type="password" placeholder="密码" class="form-control">
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<button type="submit" class="btn btn-primary btn-sm">
										  <span class="glyphicon glyphicon-add" aria-hidden="true"></span>添加
										</button>
									</td>
								</tr>
							</table>
						</form>
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