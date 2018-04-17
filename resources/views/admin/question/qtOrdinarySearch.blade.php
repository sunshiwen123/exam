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
				<h1 class="page-header">题目列表管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						
						<form class="form-horizontal" action="/qtSelect" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<table class="formtable">
								<tr>
									<td>搜索：</td>
									<td align="right">名称</td>
									<td><input @if( ! empty($qtTitle)) value="{{$qtTitle}}" @endif id="name" name="qtTitle" type="text" placeholder="输入题目名称" class="form-control"></td>
									<td align="right">科目</td>
									<td>
										<select class="form-control" name="subId">
											  <option @if( !empty($dataId) ) selected value="{{$subQcTitle->sub_id}}" @endif>@if( !empty($dataId) ) 
											  {{$subQcTitle->sub_title}} @else 选择科目名称 @endif</option>

											  @foreach( $subs as $v)
											  <option value="{{$v->sub_id}}">{{ $v->sub_title}}</option>
											  @endforeach
											  
										</select>
									</td>
									<td align="right">题目分类</td>
									<td>
										<select class="form-control" name="qcId">
											  <option @if( !empty($dataId) ) selected value="{{$subQcTitle->qc_id}}" @endif>@if( !empty($dataId) ) 
											  {{$subQcTitle->qc_title}} @else 选择分类名称 @endif</option>

											  @foreach( $qcs as $v )
											  <option value="{{$v->qc_id}}">{{$v->qc_title}}</option>
											  @endforeach

										</select>
									</td>
									<td>
										<button type="submit" class="btn btn-danger btn-sm">
								 		 		<span class="glyphicon glyphicon-search"></span>普通搜索
								 		</button>
								 	</td>
								 	<td> &nbsp; </td>
								 	<td>
										<button type="submit" class="btn btn-danger btn-sm">
								 		 		<span class="glyphicon glyphicon-search"></span>高级搜索
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop