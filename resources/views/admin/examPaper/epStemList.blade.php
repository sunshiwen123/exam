@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="/examPaperList"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active"><a href="/examPaperList"></span>返回</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">

						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<table class="formtable">
								<tr>
									
									<td class="page-header" align="right">试卷名称:</td>
									<td class="page-header" >{{$epData->ep_title}}</td>

								</tr>
								<tr>
									
									<td class="page-header" align="right">总分:</td>
									<td class="page-header" >{{$epData->ep_score_total}}分</td>

								</tr>
							</table>
<a href="/addEpStem?epId={{$epId}}" class="btn btn-danger btn-lg"><span class="glyphicon" aria-hidden="true"></span> 添加题干</a>
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
 							   <td width="5%">序号</td>
 							   <td width="35%">题型</td>
  							   <td width="10%">管理</td>
						 	</tr>

						 	@foreach($List as $k=>$v)
						 	<tr>
						 		<td>{{$k+1}}</td>
						 		<td>{{$v->qtype_title}}</td>						 	
						 		<td>
									<a href="epQtList?epId={{$epId}}&qtypeId={{$v->qtype_id}}" class="btn btn-info btn-sm">
									  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 从题库中添加试题
									</a>
									<a href="delEpStem?epId={{$epId}}&qtypeId={{$v->qtype_id}}" class="btn btn-info btn-sm">
									  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 移除
									</a>
						 		</td>
						 	</tr>
							@endforeach

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