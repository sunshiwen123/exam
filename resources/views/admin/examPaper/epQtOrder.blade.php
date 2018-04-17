@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="epQtList?epId={{$epId}}&qtypeId={{$qtypeId}}"><span class="glyphicon glyphicon-home"></span></a></li>
				<li><a href="epQtList?epId={{$epId}}&qtypeId={{$qtypeId}}"><span class="glyphicon "></span>返回</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">题目排序管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">

						 <form class="form-horizontal" action="/updateOrder" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						 	<input type="hidden" name="epId" value="{{$epId}}"/>
						 	<input type="hidden" name="qtypeId" value="{{$qtypeId}}"/>
							<table class="formtable" width='300px'>
								
								<tr>
									<td width="20%" align="right">名称</td>
									<td width="10%" align="right">顺序</td>
								</tr>
								
								@foreach($qts as $k=>$v)
								<tr>
									<td>{{$v->qt_id}}{{$v->qt_title}}</td>
									<td><input  id="name" value="{{$v->ep_qt_order}}" name="epQtOrder{{$k}}" type="text" placeholder="输入顺序1,2，3" class="form-control"></td>
						 			<input type="hidden" name="qtId{{$k}}" value="{{$v->qt_id}}"/>
									
								</tr>
								@endforeach
									<td>
										<button type="submit" class="btn btn-danger btn-sm">
								 		 		<span class="glyphicon "></span>确认
								 		</button>
								 	</td>
							</table>
					    </form>

					    <!-- <a href="/qtOrdinarySearch" class="btn btn-info btn-sm">
							  <span class="glyphicon" aria-hidden="true">搜索</span> 
						</a> -->

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