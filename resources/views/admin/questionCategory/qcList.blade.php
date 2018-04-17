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
				<h1 class="page-header">题目分类管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal" action="/qcSelect" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<table class="formtable">
								<tr>
									<td>搜索：</td>
									<td align="right">名称</td>
									<td><input  @if( ! empty( $qcTitle ) )value = "{{$qcTitle}}" @endif id="name" name="qcTitle" type="text" placeholder="输入分类名称" class="form-control"></td>
									<td align="right">科目</td>
									<td>
										<select class="form-control" name = "subId">
											  <option >选择科目名称</option>
					
											  @foreach( $subject as $v )
											  <option @if($v->sub_id == $subId) selected @endif value = "{{$v -> sub_id }}"> {{ $v->sub_title }}</option>
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
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						 <a href="/addQc" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 增加题目分类</a>
						 <?php
						 	//第一行tr
						 	$tr = [
						 		1 => [ 'width' => '20%', 'title' => '题目分类名称' ],
						 		2 => [ 'width' => '20%', 'title' => '归属科目' ],
						 		3 => [ 'width' => '60%', 'title' => '操作' ]
						 	];
						 	//menu里面td
						 	$menu_td = [
						 		0 => 'qc_title',
						 		1 => 'sub_title'
						 	];
						 	//链接a
						 	$a = [
						 		1 => [ 'web' => 'addQt', 'para1' => 'subId', 'para1Value' => 'sub_id', 'para2' => 'qcId', 'para2Value' => 'qc_id', 'para3' => 'placeholder3', 'para3Value' => '1', 'action_menu' => '增加题目' ],

						 		2 => [ 'web' => 'qtList', 'para1' => 'subId', 'para1Value' => 'sub_id', 'para2' => 'qcId', 'para2Value' => 'qc_id', 'para3' => 'placeholder3', 'para3Value' => '1', 'action_menu' => '题目管理' ],

						 		3 => [ 'web' => 'updateQc', 'para1' => 'subId', 'para1Value' => 'sub_id', 'para2' => 'qcId', 'para2Value' => 'qc_id', 'para3' => 'placeholder3', 'para3Value' => '1', 'action_menu' => '编辑该分类' ],
						 		
						 		4 => [ 'web' => 'delQcAffirm','para1' => 'subId', 'para1Value' => 'sub_id', 'para2' => 'qcId', 'para2Value' => 'qc_id', 'para3' => 'placeholder3', 'para3Value' => '1', 'action_menu' => '删除' ],
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