@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.html"><span class="glyphicon glyphicon-home"></span></a></li>
				<li class="active">题库管理</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">添加试卷</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-lg-8">
						 <form class="form-horizontal" action="addEpSubmit" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						 	<input type="hidden" name="epId" value="{{$epId}}"/>
							 <table class="formtable">
							 	<tr>
							 		 <td align="right">试卷名称：</td>
							 		 <td><input id="name" value="{{$epData->ep_title}}" name="epTitle" type="text" placeholder="输入试卷名称" class="form-control"></td>
							 	</tr>
							 	<tr>
							 		 <td align="right">归属分类：</td>
							 		 <td>
							 		 	<select class="form-control" name='epTcId'>

											  @foreach( $tree as $v)
											  <option @if( $v['tc_id'] == $epData->ep_tc_id ) selected @endif value = "{{$v['tc_id']}}">{{$v['tc_title']}}</option>

											  	 @if( !empty($v['children']))

													@foreach($v['children'] as $v1)
													<option @if( $v1['tc_id'] == $epData->ep_tc_id ) selected @endif value = "{{$v1['tc_id']}}">&nbsp;　{{$v1['tc_title']}}</option>

														 @if( !empty($v1['children']))

														 	@foreach($v1['children'] as $v2)
														 	<option @if( $v2['tc_id'] == $epData->ep_tc_id ) selected @endif value = "{{$v2['tc_id']}}">&nbsp;&nbsp;&nbsp;&nbsp;　　{{$v2['tc_title']}}</option>

														 		@if( !empty($v2['children']))

																 	@foreach($v2['children'] as $v3)
																 	<option @if( $v3['tc_id'] == $epData->ep_tc_id ) selected @endif value = "{{$v3['tc_id']}}">&nbsp;&nbsp;&nbsp;&nbsp;　　　{{$v3['tc_title']}}</option>

																	@endforeach
															 	@endif	
														 	@endforeach
														 @endif
													@endforeach
											  	 @endif
											  @endforeach

										</select>
							 		 </td>
							 	</tr>
							 	<tr>
							 		 <td></td>
							 		 <td>
							 		 	<button type="submit" class="btn btn-primary btn-lg">
							 		 		<span class="glyphicon glyphicon-plus"></span>添加试卷
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
@stop

@section('css')
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/datepicker3.css" rel="stylesheet">
<link href="/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop