@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="epQtList?epId={{$epId}}&qtypeId={{$qtypeId}}"><span class="glyphicon glyphicon-home"></span></a></li>
				<li><a href="epQtList?epId={{$epId}}&qtypeId={{$qtypeId}}"><span class="glyphicon "></span>返回</a></li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">从题库中添加题目</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						
						<form class="form-horizontal" action="/epQtSelect" method="post">
						 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						 	<input type="hidden" name="epId" value="{{$epId}}"/>
						 	<input type="hidden" name="qtypeId" value="{{$qtypeId}}"/>
							<table class="formtable">
								<tr>
									<td>搜索：</td>
									<td align="right">名称</td>
									<td><input id="name" @if( !empty($qtTitle)) value="{{$qtTitle}}" @endif name="qtTitle" type="text" placeholder="输入题目名称" class="form-control"></td>
									<td align="right">科目</td>
									<td>
										<select class="form-control" name='subId'>
											  <option >选择科目名称</option>

											  @foreach($subs as $v)
											  <option @if( !empty($subId) && $v->sub_id == $subId) selected @endif value="{{$v->sub_id}}">{{$v->sub_title}}</option>
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
						
						 <table class="table table-striped mt20">
						 	<tr>
 							   <td width="30%">题目名称</td>
 							   <td width="10%">分值</td>
 							   <td width="10%">难度</td>
 							   <td width="10%">题型</td>
 							   <td width="10%">归属题目分类</td>
 							   <td width="10%">归属科目</td>
 							   <td width="8%">使用次数</td>
 							   <td width="20%">加入试卷</td>
						 	</tr>
							@foreach( $qts as $v )
						 	<tr>
						 		<td>{{$v->qt_title}}</td>
						 		<td>{{$v->qt_score}}分</td>
						 		<td>{{$v->qt_difficulty}}</td>
						 		<td>{{$v->qtype_title}}</td>
						 		<td>{{$v->qc_title}}</td>
						 		<td>{{$v->sub_title}}</td>
						 		<td>
						 			<div class="opennumber">
							 			<a href="#">			 			
											<strong class="label label-info">{{$v->count}}</strong>
											<p>
												<b>总使用次数{{$v->count}}次</b>
												@foreach($v['children'] as $v2)
												<span>
													<em>{{$v2->created_at}}</em>
													<i>&nbsp;{{$v2->ep_use}}</i>
												</span>
												@endforeach
											</p>
							 			</a>
						 			</div>
						 		</td>
						 		<td>

									<a href="joinEp?epId={{$epId}}&qtId={{$v->qt_id}}&qtScore={{$v->qt_score}}&qtypeId={{$qtypeId}}" class="btn btn-info btn-sm">
									  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 加入试卷
									</a>
						 		</td>
						 	</tr>
							@endforeach
						 	

						 </table>
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