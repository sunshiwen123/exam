@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="/epStemList"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active"><a href="/epStemList?epId={{$epId}}"></span>返回</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<a href="/addEpQt?epId={{$epId}}&qtypeId={{$qtypeId}}" class="btn btn-danger btn-lg"><span class="glyphicon" aria-hidden="true"></span> 从题库中添加题目</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">

						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<table class="formtable">
								<tr>
									
									<td class="page-header" align="right">题型:</td>
									<td class="page-header" >{{$qtypeTitle}}</td>

								</tr>
								<tr>
									
									<td class="page-header" align="right">{{$qtypeTitle}}总分:</td>
									<td class="page-header" >0分</td>

								</tr>
							</table>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">

						 <table class="table table-striped mt20">
						 	<tr>
 							   <td width="5%">题号</td>
 							   <td width="35%">试题名称</td>
 							   <td width="5%">顺序</td>
 							   <td width="15%">归属科目</td>
 							   <td width="10%">分值</td>
 							   <td width="10%">难度</td>
 							   <td width="10%">题型</td>
 							   <td width="10%">管理</td>
						 	</tr>
						 	@foreach($List as $k=>$v)
						 	<tr>
						 		<td>{{$k+1}}</td>
						 		<td>{{$v->qt_title}}</td>
						 		<td>{{$v->ep_qt_order}}</td>
						 		<td>{{$v->sub_title}}</td>
						 		<td>{{$v->qt_score}}分</td>
						 		<td>{{$v->qt_difficulty}}</td>
						 		<td>{{$v->qtype_title}}</td>
						 		<td>

									<a href="delEpQt?qtId={{$v->qt_id}}&epId={{$epId}}&qtScore={{$v->qt_score}}&qtypeId={{$qtypeId}}" class="btn btn-info btn-sm">
									  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 移除
									</a>
						 		</td>
						 	</tr>
							@endforeach
						 </table>
						 
						 <a href="/epQtOrder?epId={{$epId}}&qtypeId={{$qtypeId}}" class="btn btn-danger btn-lg"><span class="glyphicon" aria-hidden="true"></span> 排序</a>
						 
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