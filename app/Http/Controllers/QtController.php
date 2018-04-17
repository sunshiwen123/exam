<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionCategory;
use App\Subject;
use App\Question;
use DB;


/**
 * 题目控制器
 */
class QtController extends Controller
{
	//题目列表
  /**
   * 题目列表
   * @param  Request $request 是否传入了id
   * @return view           admin.question.qtList
   */
	public function index( Request $request ){
        //获取是否传了 科目  分类 id
        $dataId = $request->all();
    		//用题目分类表去连接科目表和题目表
        $qt   = new Question();
    		$data = $qt-> join('gibs_question_categorys', 'gibs_question_categorys.qc_id', '=', 'gibs_questions.qc_id')
      			       -> join('gibs_subjects', 'gibs_questions.sub_id', '=', 'gibs_subjects.sub_id')
                   -> join( 'gibs_question_types', 'gibs_question_types.qtype_id', '=', 'gibs_questions.qtype_id')
                   -> where( function( $query ) use( $dataId ){
                            if( ! empty( $dataId )){
                                $query->where( 'gibs_questions.qc_id', '=',  $dataId['qcId']);
                            }
                       })
      			       -> select('gibs_subjects.sub_title','gibs_question_categorys.qc_id', 'gibs_question_categorys.qc_title', 'gibs_questions.*','gibs_question_types.*')
                   -> orderBy( 'gibs_questions.created_at')
          			   -> get();
        // dd($data);           
    		//获取科目id  title
        $sub  = new Subject();
        $subs = $sub-> select('sub_id', 'sub_title')
                    -> get();

        //获取题目分类 id  title
        $qc  = new QuestionCategory();
        $qcs = $qc-> select('qc_id', 'qc_title')
                  -> get();

        $subId = '';
        if( ! empty( $dataId )){
            //用传送过来的科目id，分类id，来获取科目 分类  title
            $subQcTitle = $qc-> join( 'gibs_subjects', 'gibs_subjects.sub_id', 'gibs_question_categorys.sub_id')
                             -> where( 'gibs_question_categorys.qc_id', '=', $dataId['qcId'])
                             -> first();
            $subId = $dataId['subId'];            
            return view('admin.question.qtList', ['List' => $data, 'subs' => $subs, 'qcs' => $qcs,'subId' => $subId, 'dataId' => $dataId, 'subQcTitle' => $subQcTitle]);
        }else{
            return view('admin.question.qtList', ['List' => $data, 'subs' => $subs, 'qcs' => $qcs, 'subId' => $subId]);
        } 
		
	}

    /**
     * 搜索
     * @param  Request $request 页面传递的搜索条件
     * @return view           admin.question.qtList
     */
    public function select( Request $request ){
        $data   = $request->all();
        $subId  = is_numeric($data['subId']) ? $data['subId']:''; //用三目运算来确定有没有选择科目

        $qt     = new Question();
        $qtList = $qt-> join('gibs_question_categorys', 'gibs_question_categorys.qc_id', '=', 'gibs_questions.qc_id')
                     -> join('gibs_subjects', 'gibs_subjects.sub_id', '=', 'gibs_questions.sub_id')
                     -> join( 'gibs_question_types', 'gibs_question_types.qtype_id', '=', 'gibs_questions.qtype_id')
                     -> where( function( $query ) use( $data ){
                            if( ! empty( $data['qtTitle'] )){
                                $query->where( 'qt_title', 'like', '%'.$data['qtTitle'].'%' );
                            }
                        })
                     -> where( function( $query ) use( $subId ){
                            if( ! empty( $subId )){
                                $query->where( 'gibs_questions.sub_id', '=',  $subId);
                            }
                        })
                 -> select('gibs_questions.*','gibs_subjects.sub_title','gibs_subjects.sub_id','gibs_question_categorys.qc_title','gibs_question_categorys.qc_title', 'gibs_question_types.*')
                 -> get();

        //获取科目id  title
        $sub  = new Subject();
        $subs = $sub-> select('sub_id', 'sub_title')
                    -> get();
              
        $subTitle = $sub->where('sub_id', '=', $subId)->select('sub_title')->first();

        return view('admin.question.qtList', ['List' => $qtList,'subs' => $subs,'subId' => $subId, 'subTitle' => $subTitle, 'qtTitle' => $data['qtTitle']]);
        
    }


    //题目列表 普通 搜索
    // public function qtOrdinarySearch(){
       
    //    //获取科目id  title
    //     $subs = DB::table('gibs_subjects')
    //           -> select('sub_id', 'sub_title')
    //           -> get();

    //     //获取题目分类 id  title
    //     $qcs  = DB::table('gibs_question_categorys')
    //           -> select('qc_id', 'qc_title')
    //           -> get();

    //     return view( 'admin/qtOrdinarySearch', [ 'subs' => $subs, 'qcs' => $qcs ]);
    // }


    //展示 添加单选多选判断 的页面
    /**
     * 展示 添加单选多选判断 的页面
     * @param Request $request 题目所属的科目 分类id
     */
    public function addQt(Request $request){

        //获取科目 id title
        $sub  = new Subject();
        $subs = $sub-> select('sub_id', 'sub_title')
                    -> get();

        // 是否传了科目 题目分类 id 
        $data = $request->all();

        if( ! empty($data)){
            //传了科目 分类 id title
            $subSingle = $sub-> where( 'sub_id', '=', $data['subId'] )
                             -> select( 'sub_id','sub_title' )    
                             -> first();

            return view('admin.question.addQt',[ 'subs' => $subs, 'subId' => $data['subId'], 'qcId' => $data['qcId'], 'subSingle' => $subSingle]);
        }else{
            //未传科目 分类 id
            return view('admin.question.addQt',['subs' => $subs ]);                            
        }
    }

    /**
     * 添加下一步 跳转的页面
     * @param Request $request 第一步添加时传递到第二个添加页面的数据
     */
    public function addQt2(Request $request){
        $data = $request->all();

        //根据科目id获取旗下的分类
        $qc  = new QuestionCategory();
        $qcs = $qc-> where( 'sub_id', '=', $data['subId'])
                  -> select( 'qc_id', 'qc_title')
                  -> get();

        return view('admin.question.addQt2', [ 'data' => $data, 'qcs' => $qcs]);
    }

    /**
     * 处理添加的题目数据
     * @param Request $request 页面提交的题目数据
     */
    public function addQtSubmit(Request $request){
    	$data = $request->all();
      $qt   = new Question();
    	if( ! empty( $data['qtId'] )){
      		//修改操作
      		$update_row = $qt-> where('qt_id', $data['qtId'] )
              			       -> update([
                      						'qt_title'	        => $data['qtTitle'],
                      						'qtype_id'	        => $data['qtypeId'],
                                  'qt_description'    => $data['qtDescription'],
                                  'qt_difficulty'     => $data['qtDifficulty'],
                                  'qt_score'          => $data['qtScore'],
                      						'sub_id'            => $data['subId'],
                      						'qc_id'           	=> $data['qcId'],
              					      ]);
      		if( $update_row > 0){
      			return redirect('/qtList');
      		}else{
      			return redirect('/qtList');
      		}
    	}else{
	     	if( $data['qtTitle'] ){
	    		if( $data['qcId'] && is_numeric($data['qcId']) ){

              $qt->qt_title       = $data['qtTitle'];
              $qt->qtype_id       = $data['qtypeId'];
              $qt->qt_description = $data['qtDescription'];
              $qt->qt_difficulty  = $data['qtDifficulty'];
              $qt->qt_score       = $data['qtScore'];
              $qt->qc_id          = $data['qcId'];
              $qt->sub_id         = $data['subId'];
              $qt->created_at     = date('Y-m-d H:i:s');
              $tm_id              = $qt-> save();
	    			if($tm_id){
	    				return redirect('/qtList');
	    			}else{
	    				dd('添加失败');
	    			}
	    		}else{
	    			dd('请选择分类');
	    		}
	    	}else{
	    		dd('请输入试题名称');
	    	}   		
    	}
    }

    /**
     * 展示修改题目的页面
     * @param  Request $request 题目id
     * @return view           admin.question.updateQt
     */
    public function update(Request $request){
    	$updateTmData = $request->all();//接受传送过来的id
      $qt   = new Question();
    	$data = $qt-> join( 'gibs_question_categorys', 'gibs_questions.qc_id', '=', 'gibs_questions.qc_id' )
                 -> join( 'gibs_subjects', 'gibs_subjects.sub_id', '=', 'gibs_questions.sub_id')
                 -> join( 'gibs_question_types', 'gibs_question_types.qtype_id', '=', 'gibs_questions.qtype_id')
          		   -> where('gibs_questions.qt_id', $updateTmData['qtId'])
          		   -> first();
      //获取科目
      $sub  = new Subject();
      $subData = $sub-> select( 'sub_id', 'sub_title')
                     -> get();

    	//获取题目分类
      $qc   = new QuestionCategory();
    	$qcData  = $qc-> select('qc_id', 'qc_title')
    			          -> get();

      $subId = $updateTmData['subId'];
      $qcId  = $updateTmData['qcId'];
    	return view('admin.question.updateQt', ['qtData' => $data, 'qcData' => $qcData, 'subId' => $subId, 'qcId' => $qcId, 'subData' => $subData]);
    }
    
    public function updateQt2( Request $request ){
        $data = $request->all();
        $qcId = $data['qcId'];
        $qt   = new Question();
        $qts  = $qt-> join( 'gibs_subjects', 'gibs_subjects.sub_id', '=', 'gibs_questions.sub_id' )
                   -> join( 'gibs_question_categorys', 'gibs_question_categorys.qc_id', '=', 'gibs_questions.qc_id' )
                   -> where( 'gibs_questions.qt_id', '=', $data['qtId'] )
                   -> select( 'gibs_subjects.sub_id', 'gibs_subjects.sub_title', 'gibs_question_categorys.qc_id', 'gibs_question_categorys.qc_title', 'gibs_questions.*' )
                   -> first();

        //获取题目分类
        $qc = new QuestionCategory();
        $qcData  = $qc-> where( 'sub_id', '=', $data['subId'])
                      -> select('qc_id', 'qc_title', 'sub_id')
                      -> get();
                      // dd($qts);
        return view( 'admin.question.updateQt2', [ 'data' => $data, 'qcId' => $qcId, 'qtData' => $qts, 'qcData' => $qcData] );
    }

    /**
     * 确认是否删除
     * @param  Request $request 页面传递的删除id
     * @return view            admin.question.delAffirm
     */
    public function delAffirm( Request $request ){
         $data = $request->all();
         return view( 'admin.question.delAffirm', ['data' => $data]);
    }

    //删除题目
    /**
     * 删除题目
     * @param  Request $request 页面传递的id
     * @return redirect         重定向到题目列表
     */
    public function del( Request $request){
    	$data = $request->all();
      $qt   = new Question();
    	if( is_numeric($data['qtId'])){
    		//进行删除操作
    		$del_row = $qt-> where('qt_id', $data['qtId'])
    				          ->delete();
    		if( $del_row > 0){
    			return redirect('/qtList');
    		}else{
    			dd('删除失败');
    		}
    	}
    }
}
