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
				<h1 class="page-header">修改题目</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal" action="addQtSubmit" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<input type="hidden" name="qtId" value='{{ $data['qtId'] }}'/>
							<input type="hidden" name="qtTitle" value='{{ $data['qtTitle'] }}'/>
							<input type="hidden" name="qtypeId" value='{{ $data['qtypeId'] }}'/>
							<input type="hidden" name="subId" value='{{ $data['subId'] }}'/>
							<div class="panel-heading">试题属性</div>
							<table class="formtable">
								<tr>
									<!-- <td>所属科目</td> -->
									<td>所属分类</td>
									<!-- <td>试题状态</td> -->
								</tr>
								<tr>
									<td>
										<select id="" class="form-control" name="qcId">
												<option value="">请选择分类</option>
                                         		@foreach($qcData as $v)       
                                                <option @if($v->qc_id == $qcId) selected @endif  value="{{$v->qc_id}}">{{$v->qc_title}}</option>
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
						    	 <!-- <textarea rows="3" cols="100" name = "qtDescription">{{ $qtData->qt_description }}</textarea> -->
						    	 <script id="container3" name="qtDescription" type="text/plain">
							        {!! $qtData->qt_description !!}
							    </script>
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
											<input type="radio" name="qtDifficulty" @if($qtData->qt_difficulty == 1) checked @endif id="optionsRadios1" value="1" >1级
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="qtDifficulty" @if($qtData->qt_difficulty == 2) checked @endif id="optionsRadios2" value="2">2级
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="qtDifficulty" @if($qtData->qt_difficulty == 3) checked @endif id="optionsRadios3" value="3">3级
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="qtDifficulty" @if($qtData->qt_difficulty == 4) checked @endif id="optionsRadios3" value="4">4级
										</label>
									</div>
									</div>
								</div>
								<div class="col-md-6">
						    	 	<div class="form-group">
									<label>题目分值</label>
									<div class="radio">
										<label>
											<input type="radio" name="qtScore" @if($qtData->qt_score == 1) checked @endif id="optionsRadios1" value="1">1
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="qtScore" @if($qtData->qt_score == 1.5) checked @endif id="optionsRadios2" value="1.5">1.5
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="qtScore" @if($qtData->qt_score == 2) checked @endif id="optionsRadios4" value="2">2
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="qtScore" @if($qtData->qt_score == 2.5) checked @endif id="optionsRadios5" value="2.5">2.5
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="qtScore" @if($qtData->qt_score == 3) checked @endif id="optionsRadios6" value="3">3
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
							 		 		<span class="glyphicon glyphicon-plus"></span>确认修改
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
            <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container3');
    </script>
@stop