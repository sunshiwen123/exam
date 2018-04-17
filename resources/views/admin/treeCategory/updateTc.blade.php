@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
	    <form class="form-horizontal" action="/addTcSubmit" method="post">
		 	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
		 	<input type="hidden" name="tcId"  value="{{$data->tc_id}}"/>
			<table class="formtable">
				<tr>
					
					<td align="right">用途名称</td>
					<td><input value="{{$data->tc_title}}" id="name" name="tcTitle" type="text" placeholder="输入用途名称" class="form-control"></td>
					<td>
						<button type="submit" class="btn btn-danger btn-sm">
				 		 		<span class="glyphicon "></span>提交
				 		</button>
				 	</td>
				</tr>
			</table>
	    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop