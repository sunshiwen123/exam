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
				<h1 class="page-header">修改题目分类</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-lg-8">
						 <form class="form-horizontal" action="addQcSubmit" method="post">
						 	<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
						 	<input type="hidden" name="qcId" value='{{ $updateData->qc_id }}'/>
							 <table class="formtable">
							 	<tr>
							 		 <td align="right">题目分类名称：</td>
							 		 <td><input id="name" name="qcTitle" value = "{{$updateData->qc_title}}" type="text" placeholder="分类名称" class="form-control"></td>
							 	</tr>
							 	<tr>
							 		 <td align="right">归属科目：</td>
							 		 <td>
							 		 	<select class="form-control" name='subId'>
										  @foreach($subList as $v)
										  <option  value = "{{$v->sub_id}}" @if($v->sub_id == $updateData->sub_id) selected @endif >{{ $v->sub_title }}</option>
										  @endforeach
										</select>
							 		 </td>
							 	</tr>
							 	<tr>
							 		 <td></td>
							 		 <td>
							 		 	<button type="submit" class="btn btn-primary btn-lg">
							 		 		<span class="glyphicon glyphicon-plus"></span>确认修改
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