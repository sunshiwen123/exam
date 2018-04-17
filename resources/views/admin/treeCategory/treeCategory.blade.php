@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
	<a href='addTc?pid=0'>添加1级分类</a>
					
			@foreach($tree as $k=>$v)
			<table class="formtable" border='1px soild 2px' width='400px'>
				<tr>
					<td>{{$v['tc_title']}}</td>
					<td>　　</td>
					<td>　　</td>
					<td>　　</td>
					<td><a href="addTc?pid={{$v['tc_id']}}">添加</a></td>
					<td><a href="updateTc?tcId={{$v['tc_id']}}">编辑</a></td>
					<td><a href="delTcAffirm?tcId={{$v['tc_id']}}">删除</a></td>
				</tr>
				
				@if( !empty($v['children']))
					@foreach( $v['children'] as $k1=>$v1)
						<tr>
							<td>　</td>
							<td>{{$v1['tc_title']}}</td>
							<td>　　</td>
							<td>　　</td>
							<td><a href="addTc?pid={{$v1['tc_id']}}">添加</a></td>
							<td><a href="updateTc?tcId={{$v1['tc_id']}}">编辑</td> 
							<td><a href="delTcAffirm?tcId={{$v1['tc_id']}}">删除</a></td>
						</tr>
						
						@if( !empty($v1['children']))
							@foreach( $v1['children'] as $k2=>$v2)
							　　<tr>
									<td>　　</td>
									<td>　　</td>
									<td>{{$v2['tc_title']}}</td>
									<td>　　</td>
									<td><a href="addTc?pid={{$v2['tc_id']}}">添加</a></td>
									<td><a href="updateTc?tcId={{$v2['tc_id']}}">编辑</td>
									<td><a href="delTcAffirm?tcId={{$v2['tc_id']}}">删除</a></td>
								</tr>

								@if( !empty($v2['children']))
									@foreach( $v2['children'] as $k3=>$v3)
								　　	<tr>
											<td>　　</td>
											<td>　　</td>
											<td>　　</td>
											<td>{{$v3['tc_title']}}</td>
											<td>　　</td><td>　　</td>
											<td><a href="delTcAffirm?tcId={{$v3['tc_id']}}">删除</a></td>
										</tr>
									@endforeach
								@endif

							@endforeach

						@endif

					@endforeach

				@endif

	</table><br>
			@endforeach
			
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    
@stop