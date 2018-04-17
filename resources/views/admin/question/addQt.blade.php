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
				<h1 class="page-header">添加题目</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal" action="addQt2" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<div class="panel-heading">试题属性</div>
							<table class="formtable">
								<tr>
									<td>试题名称</td>
									<td>试题类型</td>
									<!-- <td>所属科目</td> -->
									<td>所属分类</td>
									<!-- <td>试题状态</td> -->
								</tr>
								<tr>
						 		    <td>
						 		 	 	<input id="name" name="qtTitle" type="text" placeholder="试题名称" class="form-control">
						 		 	</td>
									<td>
										<select id="" class="form-control" name="qtypeId">
                                                <option value="3">判断题</option>
                                                <option value="2">多选题</option>
                                                <option value="1" selected="selected">单选题</option>
                                        </select>
									</td>
									<td>
										<select id="" class="form-control" name="subId">
                                                <option @if( ! empty($subId)) selected value="{{$subSingle->sub_id}}" @endif >@if( ! empty($subId)) {{ $subSingle->sub_title}} @else 选择科目名称 @endif</option>
                                                
                                                @foreach($subs as $v)       
                                                <option value="{{$v->sub_id}}">{{$v->sub_title}}</option>
                                        		@endforeach()

                                        </select>
									</td>
							</tr>
							</table>		

						    <div style="width:300px" class="marginauto">
							    <button type="submit" class="btn btn-primary btn-lg">
							 		 		<span class="glyphicon "></span>下一步
							 	</button>
						    </div>
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