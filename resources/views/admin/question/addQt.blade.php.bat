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
						<form class="form-horizontal" action="addQtSubmit" method="post">
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
										<select id="" class="form-control" name="qtType">
                                                <option value="binary">判断题</option>
                                                <option value="multi">多选题</option>
                                                <option value="single" selected="selected">单选题</option>
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
									<td>
										<select id="" class="form-control" name="qcId">
                                                <option @if( ! empty($qcId)) selected value="{{$qcSingle->qc_id}}" @endif >@if( ! empty($qcId)) {{ $qcSingle->qc_title}} @else 选择分类名称 @endif</option>
                                         		
                                         		@foreach($qcs as $v)       
                                                <option value="{{$v->qc_id}}">{{$v->qc_title}}</option>
                                        		@endforeach()

                                        </select>
									</td>
									<!-- <td>
										<select id="" class="form-control" name="">
                                                <option value="练习题1">练习题1</option>
                                                <option value="练习题2">练习题2</option>
                                                <option value="练习题3">练习题3</option>
                                                <option value="练习题4" selected="selected">练习题4</option>
                                        </select>
									</td> -->
								</tr>
							</table>
							<div class="panel-heading ">试题描述</div>
						    <div class="row">
						    	 <!-- <div class="panel-body"><img src="images/bjq.png"></div> -->
						    	 <textarea rows="3" cols="100" name = "qtDescription"></textarea>
						    </div>
						    <div class="panel-heading">试题选项</div>
						    <div class="row">
						    	 <div class="panel-body"><img src="images/dn.png"></div>
						    </div>
						    <div class="panel-heading">试题难度</div>
						    <div class="row">
						    	 <div class="panel-body">
						    	 	<div class="col-md-4">
						    	 	<div class="form-group">
									<label>难度选择</label>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">1级
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">2级
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">3级
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">4级
										</label>
									</div>
									</div>
								</div>
								<div class="col-md-6">
						    	 	<div class="form-group">
									<label>题目分值</label>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">1
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">1.5
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios4" value="option3">2
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios5" value="option3">2.5
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios6" value="option3">3
										</label>
									</div>
									</div>
								</div>
						    	 </div>
						    </div>

						    <div class="panel-heading">试题解析</div>
						    <div class="row">
						    	 <div class="panel-body"><img src="images/bjq.png"></div>
						    </div>
						    <div style="width:300px" class="marginauto">
							    <button type="submit" class="btn btn-primary btn-lg">
							 		 		<span class="glyphicon glyphicon-plus"></span>添加题目
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