@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="/examPaperList"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active"><a href="/epStemList?epId={{$epId}}"></span>返回</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						 					
						 <table class="table table-striped mt20">
						 	<tr>
 							   <td width="10%">序列</td>
 							   <td width="30%">题型</td>
 							   <td width="20%">管理</td>
						 	</tr>
							@foreach( $List as $k=>$v )
						 	<tr>
						 		<td>{{$k+1}}</td>
						 		<td>{{$v->qtype_title}}</td>						 		
						 		<td>
									<a href="addEpStemSubmit?epId={{$epId}}&qtypeId={{$v->qtype_id}}" class="btn btn-info btn-sm">
									  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 加入试卷
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