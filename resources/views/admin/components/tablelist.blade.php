<table class="table table-striped mt20">
 	<tr>
 		@foreach( $tr as $v)
		   <td width="{{$v['width']}}">{{$v['title']}}</td>
		@endforeach
 	</tr>
 	
 	@foreach($List as $k=>$v)
 	<tr>

 		@foreach( $menu_td as $k1=>$v1)
			@if($k1 <= 0 && $v1 == 'k')
 				<td>{{$k+1}}</td>
 			@else 
 				<td>{{ $v->$v1 }}</td> 
 			 @endif			
 		@endforeach

 		<td>
 			@foreach( $a as $v2)

 			 <?php 
 			 	//看不懂就别看了=.=！
 			 	$para1Value = $v[$v2['para1Value']]; 
 			 	if($v2['para2'] != 'placeholder2'){
					
	 			 	$para2Value = $v[$v2['para2Value']];
	 			 	if($v2['para3'] != 'placeholder3'){
	 			 		$para3Value = $v[$v2['para3Value']];
	 			 	}else{
	 			 		$para3Value = $v2['para3Value'];
	 			 	}
 			 	}else{
 			 		$para2Value = $v2['para2Value'];
 			 		$para3Value = $v2['para3Value'];
 			 		// dd($para2Value,$para3Value);
 			 	}
 			 	
 			 ?>

 			<a href="{{$v2['web']}}?{{$v2['para1']}}={{$para1Value}}&{{$v2['para2']}}={{$para2Value}}&{{$v2['para3']}}={{$para3Value}}" class="btn btn-primary btn-sm">
			  <span class="glyphicon glyphicon-" aria-hidden="true"></span> {{$v2['action_menu']}}
			</a>
			@endforeach
			<!-- <a href="qtList?subId={{$v->sub_id}}&qcId={{$v->qc_id}}" class="btn btn-success btn-sm">
			  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 题目管理
			</a>
			<a href="updateQc?qcId={{$v->qc_id}}" class="btn btn-info btn-sm">
			  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 编辑该分类
			</a>
			<a href="delQcAffirm?qcId={{$v->qc_id}}" class="btn btn-danger btn-sm">
			  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 删除该分类
			</a> -->
 		</td>

 	</tr>
 	@endforeach()
 </table>

