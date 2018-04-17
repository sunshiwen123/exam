<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\TreeCategory;
/**
 * 试卷用途分类控制器
 */
class TreeCategoryController extends Controller
{
    /**
     * 试卷用途分类列表
     * @return view        admin.treeCategory.treeCategory
     */
    public function treeCategory(){

    	$tc = new TreeCategory();
    	$categories = $tc->get();
    	//先将$categories转化为二维数组
    	$tree = array();
    	foreach($categories as $k=>$v){
    		$a['tc_id'] = $v->tc_id;
    		$a['tc_title'] = $v->tc_title;
    		$a['pid'] = $v->pid;
    		$tree[$k] = $a;
    	}
    	$categories = $tree;

    	$tree = array();		
		//第一步，将分类id作为数组key,并创建children单元  
    	foreach($categories as $category){
    		$tree[$category['tc_id']] = $category;
    		$tree[$category['tc_id']]['children'] = array();
    	}
		//第二步，利用引用，将每个分类添加到父类children数组中，这样一次遍历即可形成树形结构。    	
        foreach($tree as $key=>$item){  
            if($item['pid'] != 0){  
                $tree[$item['pid']]['children'][] = &$tree[$key];//注意：此处必须传引用否则结果不对  
                if($tree[$key]['children'] == null){  
                    unset($tree[$key]['children']); //如果children为空，则删除该children元素（可选）  
                }  
            }  
        }

        foreach($tree as $key=>$category){
            if($category['pid'] != 0){  
                unset($tree[$key]);  
            }  
        }
        // dd($tree);
        return view('admin.treeCategory.treeCategory',['tree' => $tree]);        
    }

    /**
     * 展示添加用途分类的页面
     * @param Request $request [description]
     * @return  view    admin.treeCategory.addTc
     */
    public function addTc(Request $request){
    	//分类的父id
    	$pid = $request->pid;
    	return view('admin.treeCategory.addTc',['pid' => $pid]);
    }

    /**
     * 处理提交的数据
     * @param Request $request 分类的父id
     */
    public function addTcSubmit(Request $request){
    	$data = $request->all();
    	$tc = new TreeCategory();
    	// dd($data);
    	if( ! empty($data['tcId']) ){
    		$tc-> where('tc_id',$data['tcId'])
    		   -> update([
    		   		'tc_title' => $data['tcTitle']
    		   ]);
    	}else{
			$tc->tc_title = $request->tcTitle;
			$tc->pid = $request->pid;
			$tc->save();
    	}

    	return redirect('treeCategory');
    }

    /**
     * 展示编辑页面
     * @param  Request $request 编辑的id
     * @return view           admin.treeCategory.addTc
     */
    public function updateTc(Request $request){
    	$tcId = $request->tcId;
    	$tc = new treeCategory();
    	$data = $tc->where('tc_id', $tcId)->first();
    	// dd($tcId,$data->tc_title);
    	return view('admin.treeCategory.updateTc',['data' => $data]);
    }

    public function delTcAffirm(Request $request){
    	$data = $request->all();
    	
    	// dd($data);
    	//查询旗下有无子分类
    	$tc = new TreeCategory();
    	$tcs = $tc->where('pid', $data['tcId'])->first();

    	return view('admin.treeCategory.delTcAffirm', ['tcs' => $tcs, 'data' => $data]);
    }

    public function delTc(Request $request){
    	$data = $request->all();
    	$tc = new TreeCategory();
    	$del_row = $tc->where('tc_id', $data['tcId'])->delete();
    	return redirect('treeCategory');
    }	
}
