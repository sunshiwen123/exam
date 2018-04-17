<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Subject;
use App\QuestionCategory;
use DB;

/**
 * 科目控制器
 */
class SubjectController extends Controller
{

    /**
     * 科目列表
     * @return view   admin.subject.subList
     */
    public function subjectList(){
        $userName = session('userName');
        // dd($userName, session('userSign'));
        $sub     = new Subject();
        $subList = $sub->get();
        return view('admin.subject.subList', ['List' => $subList]);
    }

    /**
     * 科目搜索
     * @param  Request $request 页面传递的搜索条件
     * @return view           admin.subject.subList
     */
    public function select( Request $request ){
        $data    = $request->all();
        $sub     = new Subject();
        $subList = $sub
                 -> where('sub_title', 'like', '%'.$data['subTitle'].'%')
                 -> get();
        return view(' admin.subject.subList', ['List' => $subList, 'subTitle' => $data['subTitle']]);//$data['subTitle'] 指的是 搜索的条件 科目title
    }



    /**
     * 添加科目数据   
     * @param Request $request 页面用户输入
     */
    public function add(Request $request){
    	$subKm = $request->all();//提交的内容
        $sub   = new Subject();
        if(! empty($subKm['subId'])){
            //进行修改操作
            
            $update_row = $sub
                        ->where('sub_id', $subKm['subId'])
                        ->update(['sub_title' => $subKm['subTitle']]);
            if( $update_row >= 0){
                return redirect('/');
            }else{
                dd('修改失败');
            }
        }else{
            if(!empty($subKm['sub_title'])){
                //插入数据库
                $content =  $subKm['sub_title'];
                $sub->sub_title  = $content;
                $sub->created_at = date('Y-m-d H:i:s');
                $id              = $sub->save();
                if(!empty($id)){
                    //插入成功
                    return redirect('/');
                }else{
                    //插入失败
                    dd('插入失败');
                }
            }else{
                //输出‘请出入数据到页面’
                dd('数据为空');
            }
        }
        

    }

    /**
     * 展示修改科目数据的页面 
     * @param  Request $request 页面用户输入
     * @return view           admin.subject.updateSub
     */
    public function update(Request $request){
        $updateKm = $request->all();
        $sub      = new Subject();
        $data     = $sub
                  ->where('sub_id','=',$updateKm['subId'])
                  ->first();

        return view('admin.subject.updateSub',['updateData' => $data]);
    }

    /**
     * 是否确认删除
     * @param  Request $id 页面传递过来的删除id
     * @return view      admin.subject.delSubAffirm
     */
    public function delSubAffirm( Request $id ){
        $data = $id->all();
        //查询此科目下面是否还有分类
        $qc  = new QuestionCategory();
        $qcs = $qc
             -> where( 'sub_id', $data['subId'])
             -> first();

        return view( 'admin.subject.delSubAffirm', ['qcs' => $qcs, 'data' => $data]);
    }

    /**
     * 确认删除
     * @param  Request $id 页面传递的id
     * @return view      / 科目列表首页
     */
    public function del(Request $id){
        $data    = $id->all();
        $sub     = new Subject();
        $del_row = $sub->where('sub_id', $data['subId'])->delete();
        if($del_row != 0){
            return redirect('/');
        }else{
            dd('删除失败');
        }


    }


}
