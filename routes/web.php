<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//     return view('admin/dashboard');
// });

//登录页面和系统设置
Route::get('/', 'UserController@login'); //登录页面

Route::post('/loginSubmit', 'UserController@loginSubmit');//处理登录信息

Route::get('/teacherMan', 'UserController@teacherMan');//老师管理页面

Route::get('/resetPwd', 'UserController@resetPwd');//账号管理

Route::get('/addTeacher', 'UserController@addTeacher');//展示添加老师的页面

Route::post('/addTeacherSubmit', 'UserController@addTeacherSubmit');//处理老师数据


//科目路由开始
Route::get('/subjectList', 'SubjectController@subjectList');//科目分类列表首页

Route::post('/select', 'SubjectController@select');//科目分类列表搜索

Route::get('/addSub', function () {//点击添加科目时的路由
    return view('admin.subject.addSub');
});

Route::post('/addSub','SubjectController@add');//处理提交的科目

Route::get('/updateSub','SubjectController@update');//展示科目编辑页面

Route::get('/delSubAffirm','SubjectController@delSubAffirm');//是否确认删除

Route::get('/delSub','SubjectController@del');//删除科目
//科目路由结束


//题目分类路由开始
Route::get('/qcList', 'QcController@index');//题目分类列表首页
Route::get('/qcListsss', 'QcController@index');//题目分类列表首页
Route::post('/qcSelect', 'QcController@select');//题目分类列表搜索

Route::get('/addQc','QcController@addQc');//展示添加分类的页面

Route::post('addQcSubmit', 'QcController@addQcSubmit');//添加题目分类 提交

Route::get('/updateQc','QcController@update');//展示题目分类编辑页面

Route::get('delQcAffirm', 'QcController@delQcAffirm');//是否确认删除

Route::get('delQc', 'QcController@del');//删除题目分类
//题目分类路由结束



//题目列表路由开始
Route::get('/qtList', 'QtController@index');//题目列表首页

Route::post('/qtSelect', 'QtController@select');//题目列表搜索
// 
Route::get('/qtOrdinarySearch', 'QtController@qtOrdinarySearch');//题目列表 普通 搜索

Route::get('/qtAdvancedSearch', 'QtController@qtAdvancedSearch');//题目列表 普通 搜索

Route::get('/addQt', 'QtController@addQt');  //添加单选题、多选题、判断题

Route::post('addQt2', 'QtController@addQt2');//添加题目内容 提交

Route::post('addQtSubmit', 'QtController@addQtSubmit');//添加题目内容 提交

Route::get('/updateQt','QtController@update');//展示题目编辑 下一步 页面

Route::post('/updateQt2','QtController@updateQt2');//展示题目编辑 第一个页面


Route::get('delAffirm', 'QtController@delAffirm');//是否确认删除

Route::get('delQt', 'QtController@del');//删除题目

//题目列表路由结束


//组卷开始
Route::get('/examPaperList', 'ExamPaperController@index');//试卷的列表

Route::get( 'addEp', 'ExamPaperController@addEp');//展示添加试卷名称的页面

Route::post( 'addEpSubmit', 'ExamPaperController@addEpSubmit');//添加试卷名称

Route::get( 'epQtList', 'ExamPaperController@epQtList');//展示试卷名称和旗下的试题

Route::get( 'addEpQt', 'ExamPaperController@addEpQt');//展示添加试题的页面

Route::get( 'joinEp', 'ExamPaperController@joinEp');//加入试卷

Route::post( 'epSelect', 'ExamPaperController@epSelect');//试卷搜索

Route::get( 'delEpAffirm', 'ExamPaperController@delEpAffirm');//确认是否删除试卷

Route::get( 'delEp', 'ExamPaperController@delEp');//删除试卷

Route::get( 'delEpQt', 'ExamPaperController@delEpQt');//移除试卷中的题目

Route::post( 'epQtSelect', 'ExamPaperController@epQtSelect');//对题库的题目进行搜索

Route::get( 'epQtOrder', 'ExamPaperController@epQtOrder');//对题库的题目进行搜索

Route::post( 'updateOrder', 'ExamPaperController@updateOrder');//处理排序结果

Route::get('updateEp', 'ExamPaperController@updateEp');//展示试卷名称修改页面

Route::get('epStemList', 'ExamPaperController@epStemList');//试卷题干列表

Route::get('addEpStem', 'ExamPaperController@addEpStem');//添加题干

Route::get('addEpStemSubmit', 'ExamPaperController@addEpStemSubmit');//处理添加题干的数据

Route::get('delEpStem', 'ExamPaperController@delEpStem');//移除题干
//组卷结束

/**
 * 试卷用途分类开始
 */
Route::get( 'treeCategory', 'TreeCategoryController@treeCategory');//试卷用途分类列表

Route::get('addTc', 'TreeCategoryController@addTc');//展示添加用途分类页面

Route::post('addTcSubmit', 'TreeCategoryController@addTcSubmit');//处理提交的数据

Route::get('updateTc', 'TreeCategoryController@updateTc');//展示编辑页面

Route::get('delTcAffirm', 'TreeCategoryController@delTcAffirm');//是否确认删除

Route::get('delTc', 'TreeCategoryController@delTc');//确认删除
//试卷用途分类结束

//系统设置开始
// Route::get('systemSet', 'TreeCategoryController@delTc');//确认删除
