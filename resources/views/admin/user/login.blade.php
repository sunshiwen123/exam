@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<h1 class="loginlogo">
				<img src="/images/logo.png">
				<strong>东大外院题库管理系统</strong>
				<a href="topic.html"></a>
			</h1>
			<div class="login-panel panel panel-default">
				<div class="panel-body">
					<form role="form" action="loginSubmit" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="用户名" name="userName" type="user" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="密    码" name="userPwd" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">记住密码
								</label>
							</div>
							<!-- <a href="index.html" class="btn btn-primary">Login</a> -->
							<button type="submit" class="btn btn-primary btn-lg">
							 		<span class="glyphicon "></span>Login
							</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div>
@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    
@stop