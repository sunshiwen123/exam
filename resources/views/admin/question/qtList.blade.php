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
									<td><input @if( ! empty($qtTitle) ) value="{{$qtTitle}}" @endif id="name" name="qtTitle" type="text" placeholder="输入题目名称" class="form-control"></td>
									<td align="right">科目</td>
									
									<td>
										<select class="form-control" name="subId">
											  <option >选择科目名称</option>

											  @foreach( $subs as $v)
											  <option @if($v->sub_id == $subId) selected @endif value="{{$v->sub_id}}">{{ $v->sub_title}}</option>
											  @endforeach
										</select>
									</td>


									<td>
										<button type="submit" class="btn btn-danger btn-sm">
								 		 		<span class="glyphicon glyphicon-search"></span>搜索
								 		</button>
								 	</td>
								</tr>
							</table>
					    </form>

					    <!-- <a href="/qtOrdinarySearch" class="btn btn-info btn-sm">
							  <span class="glyphicon" aria-hidden="true">搜索</span> 
						</a> -->

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="clearfix">
							<div class="col-lg-2 tmlistbtn">
								 <a href="/addQt" class="btn btn-primary">
								 	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								 	<b>添加题目</b>
								 </a>
							 </div>
						 </div>
						
						 <?php
						 	//第一行tr
						 	$tr = [
						 		1 => [ 'width' => '20%', 'title' => '题目名称' ],
						 		2 => [ 'width' => '10%', 'title' => '题型' ],
						 		3 => [ 'width' => '5%', 'title' => '分值' ],
						 		4 => [ 'width' => '5%', 'title' => '难度' ],
						 		5 => [ 'width' => '15%', 'title' => '添加时间' ],
						 		6 => [ 'width' => '10%', 'title' => '归属题目分类' ],
						 		7 => [ 'width' => '20%', 'title' => '归属科目' ],
						 		8 => [ 'width' => '15%', 'title' => '操作' ],
						 	];
						 	//menu里面td
						 	$menu_td = [
						 		0 => 'qt_title',
						 		1 => 'qtype_title',
						 		2 => 'qt_score',
						 		3 => 'qt_difficulty',
						 		4 => 'created_at',
						 		5 => 'qc_title',
						 		6 => 'sub_title',
						 	];
						 	//链接a
						 	$a = [
						 		1 => [ 'web' => 'updateQt', 'para1' => 'qtId', 'para1Value' => 'qt_id', 'para2' => 'subId', 'para2Value' => 'sub_id', 'para3' => 'qcId', 'para3Value' => 'qc_id','action_menu' => '编辑' ],

						 		2 => [ 'web' => 'delAffirm','para1' => 'qtId', 'para1Value' => 'qt_id', 'para2' => 'placeholder2', 'para2Value' => '0', 'para3' => 'placeholder3', 'para3Value' => '1','action_menu' => '删除' ],
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
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop