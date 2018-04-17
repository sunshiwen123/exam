<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\QuestionCategory;
use App\Subject;
use App\Question;
use DB;

/**
 * 题目分类控制器
 */
class QcController extends Controller
{
    /**
     * 题目分类列表 
     * @return view admin.questionCategory.qcList
     */
    public function index(){

      $qc = new QuestionCategory();
      $qcList = $qc-> join('gibs_subjects','gibs_question_categorys.sub_id','=','gibs_subjects.sub_id')
    			         -> select('gibs_question_categorys.*','gibs_subjects.sub_title')
                   -> get();
        
      //获取科目名称和id
      $sub = new Subject();
      $subject2 = $sub-> select('sub_id', 'sub_title')
                      -> get();
      $subId = '';
      
      
    	return view('admin.questionCategory.qcList',['List' => $qcList, 'subject' => $subject2, 'subId' => $subId ]);
    }

    /**
     * 题目分类搜索
     * @param  Request $request 页面传递的搜索条件
     * @return [type]           admin.questionCategory.qcList
     */
    public function select( Request $request ){
        $data = $request->all();

        $subId = is_numeric($data['subId']) ? $data['subId']:''; //用三目运算来确定有没有选择科目

        $qc = new QuestionCategory();
        $qcList = $qc-> join('gibs_subjects','gibs_question_categorys.sub_id','=','gibs_subjects.sub_id')
                     -> where( function( $query ) use( $data ){
                          if( ! empty( $data['qcTitle'] )){
                              $query->where( 'qc_title', 'like', '%'.$data['qcTitle'].'%' );
                          }
                        })
                     -> where( function( $query ) use( $subId ){
                          if( ! empty( $subId )){
                              $query->where( 'gibs_question_categorys.sub_id', '=',  $subId);
                          }
                        })
                     -> select('gibs_question_categorys.*','gibs_subjects.sub_title')
                     -> get();
        
        //获取科目名称和id
        $sub = new Subject();
        $subject2 = $sub-> select('sub_id', 'sub_title')
                        -> get();        
         
        //获取条件科目(用于点击搜索之后，显示之前搜索的是哪个科目)
        $subTitle = $sub-> where('sub_id', '=', $subId)
                        -> select('sub_title')
                        -> first();

        return view('admin.questionCategory.qcList',[ 'List' => $qcList, 'subject' => $subject2, 'qcTitle' =>  $data['qcTitle'], 'subId' => $subId, 'subTitle' => $subTitle ]);
    }

    /**
     * 展示 增加题目分类(同时获取科目列表)的页面
     * @param Request $request 页面传递的科目id（从科目列表的添加分类 进入）
     */
    public function addQc( Request $request ){
    	//获取科目列表
      $sub      = new Subject();
    	$subTitle = $sub-> select('sub_id','sub_title')	
    			            -> get();

        // 是否传了科目id 
    	$data = $request->all();        
      if( ! empty($data)){
            $subSingle = $sub-> where( 'sub_id', '=', $data['subId'])
                             -> select( 'sub_id', 'sub_title' )    
                             -> first();

            return view('admin.questionCategory.addQc',['subTitle'=>$subTitle, 'subId' => $data['subId'], 'subSingle' => $subSingle]);//传了科目id
      }else{
           //防止报错，默认subId=''
            $subId = '';
            return view('admin.questionCategory.addQc',['subTitle'=>$subTitle, 'subId' => $subId]);                           //未传科目id
      }    	
    }

    /**
     * 对提交的添加题目分类进行处理
     * @param Request $request 页面传递过来的数据
     */
    public function addQcSubmit(Request $request){
    	$data = $request->all();
      $qc   = new QuestionCategory();
    	if( ! empty($data['qcId']) ){
    		//修改操作        
    		$update_row = $qc-> where('qc_id', $data['qcId'])
    					           -> update(['qc_title' => $data['qcTitle'], 'sub_id' => $data['subId']]);
    		if( $update_row >= 0){
                return redirect('qcList');
    		}else{
    			dd('修改失败');
    		}
    	}else{
	     	if($data['qcTitle']){
	    		if($data['subId'] && is_numeric($data['subId'])){
	    			
              $qc->qc_title   = $data['qcTitle']; 
              $qc->sub_id     = $data['subId']; 
              $qc->created_at = date('Y-m-d H:i:s');
              $fl_id          = $qc->save();

  	    			if($fl_id){
                 return redirect('qcList');	    	
  	    			}else{
  	    				dd('添加分类失败');
  	    			}	    			
	    		}else{
	    			dd('请选择所属科目');
	    		}
	    	}else{
	    		dd('请输入分类名称');
	    	}   		
    	}
    }

    /**
     * 展示编辑的页面
     * @param  Request $request 页面传递过来的qcid
     * @return view            admin.questionCategory.delQcAffirm
     */
    public function update( Request $request ){
    	$updateTmFlData = $request->all();
      // 获取修改的内容
      $qc   = new QuestionCategory();
    	$data = $qc-> join('gibs_subjects', 'gibs_question_categorys.sub_id', '=', 'gibs_subjects.sub_id')
          		   -> where('gibs_question_categorys.qc_id', $updateTmFlData['qcId'])
          		   -> select( 'gibs_question_categorys.*', 'gibs_subjects.sub_title','gibs_subjects.sub_id')
          		   -> first();

    	// 获取科目列表
      $sub     = new Subject(); 
    	$subList = $sub->select('sub_id', 'sub_title')->get();

    	return view('admin.questionCategory.updateQc', ['updateData' => $data,'subList' => $subList ]);
    }

    /**
     * 是否删除分类
     * @param  Request $request 页面传递的分类id
     * @return view           admin.questionCategory.delQcAffirm
     */
    public function delQcAffirm( Request $request ){
         $data = $request->all();
         return view( 'admin.questionCategory.delQcAffirm', ['data' => $data]);
    }

    /**
     * 删除题目分类(同时删除旗下的题目)
     * @param  Request $id 页面传递的要删除 分类id
     * @return redirect      重定向到分类列表页面
     */
    public function del( Request $id){
    	$data = $id->all();
      $qc   = new QuestionCategory();
      $qt   = new Question();
    	if( is_numeric($data['qcId']) ){
    		  $del_row  = $qc-> where('qc_id', $data['qcId'])
    				             -> delete();
          $del_rows = $qt-> where( 'qc_id', $data['qcId'])
                         -> delete();
    		if(is_numeric($del_row ) && is_numeric($del_rows)){
    			return redirect('qcList');
    		}else{
    			dd('删除失败1');
    		}
    	}else{
    		dd('删除失败2');
    	}

    }
}


