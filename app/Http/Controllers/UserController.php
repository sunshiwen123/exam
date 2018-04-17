<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

/**
 * 登录控制器
 */
class UserController extends Controller
{
	//登录页面
	public function login(){
		return view('admin.user.login');
	}

	//验证登录
	public function loginSubmit( Request $request ){
		$data = $request->all();
		//利用用户名去查询密码是否正确；
		$user = new User();
		$selectData = $user->where('user_name', $data['userName'])->first();
		// dd($selectData);
		if(!empty($selectData)){
			if( md5($data['userPwd']) == $selectData['user_pwd'] ){
				//将用户信息存储到session中
				session(['userName' => $selectData['user_name'], 'userSign' => $selectData['user_sign']]);  
				return redirect('subjectList');
			}else{
				dd('密码错误');
			}
		}else{
			dd('用户名不存在');
		}
		
	}

	//老师管理
	public function teacherMan(){
		//获取老师列表
		$user = new User();
		$data = $user->where('user_sign', '0')->get();
		// dd($data);
		return view('admin.user.teacherMan', ['List' => $data]);
	}

	//账号管理
	public function resetPwd(){
		return view('admin.user.resetPwd');
	}

	//展示添加老师页面
	public function addTeacher(){
		return view('admin.user.addTeacher');
	}

	//处理老师数据
	public function addTeacherSubmit( Request $request ){
		$data    = $request->all();
		$userPwd = md5($data['userPwd']);
		$user    = new User();
		$user->user_name = $data['userName'];
		$user->user_tel  = $data['userTel'];
		$user->user_pwd  = $userPwd;
		$user->user_sign = 0;
		$user->save();
		return redirect('teacherMan');
		// dd($data);
	}

}