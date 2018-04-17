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
				<h1 class="page-header">科目列表</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default clearfix">
					<div class="panel-body">
					    <form class="form-horizontal" action="/select" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						    <div class="col-md-6">
						    	<div class="input-group">
									<div class="input-group-addon">科目名称</div>
									<input class="form-control" name="subTitle" id="" type="text" @if( ! empty( $subTitle ) )value = "{{$subTitle}}" @endif >
								</div>
						    </div>
						    
						    <!-- <div class="col-md-6">
						    	<a href="" class="btn btn-success">搜索</a>
						    </div> -->
						    <button type="submit" class="btn btn-danger btn-sm">
								 		 		<span class="glyphicon glyphicon-search"></span>搜索
								 		</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<a href="/addSub" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 增加科目</a>
						 <?php
						 	//第一行tr
						 	$tr = [
						 		1 => [ 'width' => '35%', 'title' => '科目名称' ],
						 		2 => [ 'width' => '10%', 'title' => '添加时间' ],
						 		3 => [ 'width' => '25%', 'title' => '操作' ]
						 	];
						 	//menu里面td
						 	$menu_td = [
						 		0 => 'sub_title',
						 		1 => 'created_at'
						 	];
						 	//链接a
						 	$a = [
						 		1 => [ 'web' => 'addQc', 'para1' => 'subId', 'para1Value' => 'sub_id', 'para2' => 'placeholder2', 'para2Value' => '0', 'para3' => 'placeholder3', 'para3Value' => '1','action_menu' => '添加题目分类' ],

						 		2 => [ 'web' => 'updateSub', 'para1' => 'subId', 'para1Value' => 'sub_id', 'para2' => 'placeholder2', 'para2Value' => '0', 'para3' => 'placeholder3', 'para3Value' => '1','action_menu' => '编辑科目' ],

						 		3 => [ 'web' => 'delSubAffirm','para1' => 'subId', 'para1Value' => 'sub_id', 'para2' => 'placeholder2', 'para2Value' => '0', 'para3' => 'placeholder3', 'para3Value' => '1','action_menu' => '删除' ],
						 	];

						 ?>
						 @include('admin.components.tablelist',['tr' => $tr, 'menu_td' => $menu_td, 'a' => $a, ])

						 
						 <div class="tablepage">
							 <div class="tablepageleft">
							 	pages 1/20
							 </div>
							 <div class="tablepagelist">
							 	 <ul>
							 	 	 <li><a href="" class="current">1</a></li>
							 	 	 <li><a href="">2</a></li>
							 	 	 <li><a href="">3</a></li>
							 	 	 <li><a href="">4</a></li>
							 	 	 <li><a href="">...</a></li>
							 	 	 <li><a href="">18</a></li>
							 	 	 <li><a href="">19</a></li>
							 	 	 <li><a href="">20</a></li>
							 	 </ul>
							 </div>
						 </div>
					</div>
				</div>
			</div>
		</div>
@stop

@section('css')
	<link rel="stylesheet" href="/css/admin_custom.css">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet"> -->
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop