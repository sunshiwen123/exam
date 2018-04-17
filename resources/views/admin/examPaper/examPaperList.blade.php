@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
						

		<div class="row">
			<div class="col-lg-12">
				<a href="/addEp" class="btn btn-danger btn-lg"><span class="glyphicon" aria-hidden="true"></span> 添加试卷名称</a>
				<h1 class="page-header">试卷列表</h1>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">

						<form class="form-horizontal" action="/epSelect" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<table class="formtable">
								<tr>
									<td>搜索：</td>
									<td align="right">试卷名称</td>
									<td><input id="name" @if( !empty($epTitle)) value = "{{$epTitle}}" @endif name="epTitle" type="text" placeholder="输入试卷名称" class="form-control"></td>
									
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
						 <?php
						 	//第一行tr
						 	$tr = [
						 		1 => [ 'width' => '5%', 'title' => '序列' ],
						 		2 => [ 'width' => '30%', 'title' => '试卷名称' ],
						 		3 => [ 'width' => '20%', 'title' => '用途' ],
						 		4 => [ 'width' => '10%', 'title' => '总分' ],
						 		5 => [ 'width' => '15%', 'title' => '添加时间' ],
						 		6 => [ 'width' => '30%', 'title' => '操作' ]
						 	];
						 	//menu里面td
						 	$menu_td = [
						 		0 => 'k',
						 		1 => 'ep_title',
						 		2 => 'ep_use',
						 		3 => 'ep_score_total',
						 		4 => 'created_at',
						 	];
						 	//链接a addEpStem epStemList epQtList
						 	$a = [
						 		1 => [ 'web' => 'epStemList', 'para1' => 'epId', 'para1Value' => 'ep_id', 'para2' => 'placeholder2', 'para2Value' => '0', 'para3' => 'placeholder3', 'para3Value' => '1','action_menu' => '添加试题' ],

						 		2 => [ 'web' => 'updateEp', 'para1' => 'epId', 'para1Value' => 'ep_id', 'para2' => 'placeholder2', 'para2Value' => '0', 'para3' => 'placeholder3', 'para3Value' => '1','action_menu' => '修改试卷' ],

						 		3 => [ 'web' => 'delEpAffirm','para1' => 'epId', 'para1Value' => 'ep_id', 'para2' => 'placeholder2', 'para2Value' => '0', 'para3' => 'placeholder3', 'para3Value' => '1','action_menu' => '删除试卷' ],
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