<?php

namespace App\Http\Controllers;
use App\User;

/**
 * 登录控制器
 */
class UserController extends Controller()
{
	//登录页面
	public function login(){
		return view('admin.user.login');
	}
}