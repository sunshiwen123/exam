<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\ExamPaper;
use App\EpQtRelation;
use App\Question;
use App\QuestionCategory;
use App\Subject;
use App\TreeCategory;
use App\QuestionType;
use App\EpQtypeRelation;

/**
 * 试卷控制器
 */

class ExamPaperController extends Controller
{
    /**
     * 显示当下试卷列表
     * @return [view] [admin.examPaper.exampPageList]
     */
    public function index(){
        $ep = new ExamPaper();
        $epData = $ep->leftjoin('gibs_tree_categorys', 'gibs_exam_papers.ep_tc_id', '=', 'gibs_tree_categorys.tc_id')
                     ->get();
        // dd($epData);             
    	return view('admin.examPaper.examPaperList', ['List' => $epData]);
    }

    /**
     * 试卷搜索功能 
     * @param  Request $request 用户输入的搜索条件
     * @return [view]           [admin.examPaper.examPaperList]
     */
    public function epSelect( Request $request ){
        $ep = new ExamPaper();
    	$data = $request->all();
    	$epTitle = $data['epTitle'];
    	$epData = $ep
                ->where( function( $query ) use( $epTitle ){
                      if( ! empty( $epTitle )){
                          $query->where( 'ep_title', 'like', '%'.$epTitle.'%' );
                      }
                 })
    			-> get();

    	return view('admin.examPaper.examPaperList', ['List' => $epData, 'epTitle' => $epTitle]);
    }

    /**
     * 处理用途分类的公共代码
     */
    private function _treeCategory(){
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
        return $tree;
    }

    /**
     * 添加试卷名称页面
     */
    public function addEp(){
        

        $tree = $this->_treeCategory();
        // dd($tree);        
    	return view('admin.examPaper.addEp', ['tree' => $tree]);
    }

    /**
     * 处理 用户提交的试卷名称
     * @param request $request 用户输入的试卷名称
     */
    public function addEpSubmit( Request $request ){
    	//同时保存或更新试卷名称
    	$epData = $request->all();
        $ep = new ExamPaper();

        //查询此分类的上一级
        $tc = new TreeCategory();
        $epUse = '';    //用此来拼接用途 插入数据库
        $data  = $tc->where('tc_id', $epData['epTcId'])->select('tc_title', 'pid')->first();
        $epUse = $data['tc_title'];
        $pid   = $data['pid'];

        while($pid != 0){
            $data = $tc->where('tc_id', $pid)->select('tc_title', 'pid')->first();
            $epUse =  $data['tc_title'].'-'.$epUse;
            $pid = $data['pid'];
        }

        // dd($epData,$pid,$epUse);
        
        if(! empty($epData['epId'])){
            $ep->where('ep_id', $epData['epId'])
               ->update([
                    'ep_title'  => $epData['epTitle'],
                    'ep_tc_id'  => $epData['epTcId'],
                    'ep_use'    => $epUse
                 ]);
            return redirect('/examPaperList');
        }else{
            if( ! empty($epData['epTitle']) ){
                
                $ep->ep_title        = $epData['epTitle'];
                $ep->ep_score_total  = 0;
                $ep->ep_tc_id        = $epData['epTcId'];
                $ep->ep_use          = $epUse;
                $ep->created_at      = date('Y-m-d H:i:s');
                $epId                = $ep->save();
                if(! empty($epId)){
                    return redirect('/examPaperList');
                }else{
                    dd('试卷名称添加失败');
                }
            }else{
                return view('admin.examPaper.warning');
            }            
        }
    }

    /**
     * 添加题干的公共代码
     */
    private function _epStem($epId){
        //根据关联表中的id关系来获取试卷旗下的题干
        $qtypeRe = new EpQtypeRelation();
        $typeData = $qtypeRe-> where('ep_id', $epId)
                           -> select( 'qtype_id')
                           -> get();
        $qtypeIds = [];
        if( !empty($typeData) ){
            foreach($typeData as $k=>$v){
                $qtypeIds[$k] = $v->qtype_id;
            }
        }
        //获取题干
        $qtype = new QuestionType();
        $typeData = $qtype-> join('gibs_ep_questiontype_relations', 'gibs_ep_questiontype_relations.qtype_id', '=', 'gibs_question_types.qtype_id')
                          -> where( function( $query ) use( $qtypeIds ){
                              if( ! empty( $qtypeIds ) ){
                                  $query->whereIn( 'gibs_question_types.qtype_id', $qtypeIds);
                              }
                             })
                          -> where( 'gibs_ep_questiontype_relations.ep_id', $epId)
                          -> get();        
   
        //获取试卷信息
        $ep = new ExamPaper();
        $epData = \App\ExamPaper::
                   where( 'ep_id',$epId )
                -> select( 'ep_title','ep_score_total' )
                -> first();    
        // $epTitle = $epData->ep_title;    
      return view('admin.examPaper.epStemList', ['epId' => $epId, 'List' => $typeData, 'epData' => $epData]);
    }

    /**
     * 试卷的题干列表
     * @param  Request $request 页面传递的id
     * @return [type]           [description]
     */
    public function epStemList(Request $request){
        $epId = $request->epId;
        return $this->_epStem($epId);
    }

    /**
     * 添加题干列表
     * @param Request $request 页面传递的id
     * @return view           admin.examPaper.addEpStem
     */
    public function addEpStem(Request $request){
        $epId = $request->epId;
        //查询此试卷id下的题干
        $qtypeRe = new EpQtypeRelation();
        $typeData = $qtypeRe -> where('ep_id', $epId)->select('qtype_id')->get();

        $qtypeIds = [];//默认为空数组
        
        if( !empty($typeData) ){
            foreach($typeData as $k=>$v){
                $qtypeIds[$k] = $v->qtype_id;
            }
        }
        // dd($typeData);
        //获取题干
        $qtype = new QuestionType();
        $typeData = $qtype-> where( function( $query ) use( $qtypeIds ){
                              if( ! empty( $qtypeIds ) ){
                                  $query->whereNotIn( 'gibs_question_types.qtype_id', $qtypeIds);
                              }
                             })

                          -> get();
        // dd($qtypeIds,$typeData);
        return view('admin.examPaper.addEpStem', ['epId' => $epId, 'List' => $typeData]);

    }

    /**
     * 题干加入
     * @param Request $request 页面传递的id
     */
    public function addEpStemSubmit( Request $request ){
        $data = $request->all();
        $epId = $data['epId'];
        // dd($data);
        $qtypeRe = new EpQtypeRelation();
        $qtypeRe->ep_id = $data['epId'];
        $qtypeRe->qtype_id = $data['qtypeId'];
        $insertBool = $qtypeRe->save();

        $typeData = $qtypeRe -> where('ep_id', $epId)->select('qtype_id')->get();

        $qtypeIds = [];//默认为空数组
        
        if( !empty($typeData) ){
            foreach($typeData as $k=>$v){
                $qtypeIds[$k] = $v->qtype_id;
            }
        }

        //获取题干
        $qtype = new QuestionType();
        $typeData = $qtype-> where( function( $query ) use( $qtypeIds ){
                              if( ! empty( $qtypeIds ) ){
                                  $query->whereNotIn( 'gibs_question_types.qtype_id', $qtypeIds);
                              }
                             })
                          -> get();  
        return view('admin.examPaper.addEpStem', ['epId' => $epId, 'List' => $typeData]);                        
    }

    /**
     * 移除题干 
     * @param  Request $request 页面传递过来要删除的id
     * @return view           admin.examPaper.epStemList
     */
    public function delEpStem(Request $request){
        $data = $request->all();
        $epId = $data['epId'];
        $qtypeId = $data['qtypeId'];
        $qtypeRe = new EpQtypeRelation();
        $del_row = $qtypeRe-> where('ep_id', $data['epId'])
                           -> where('qtype_id', $data['qtypeId'])
                           -> delete();
        //删除旗下关联的题目
        $eqr = new EpQtRelation();
        $del_row2 = $eqr-> where('qtype_id', $qtypeId)
                        -> where( 'ep_id', $epId)
                        -> delete();
        return $this->_epStem($epId);                   
    }

    /**
     * 展示修改试卷名称的页面
     * @param  Request $request 要修改的id
     * @return view           admin.examPaper.updateEp
     */
    public function updateEp( Request $request ){
        $tree = $this->_treeCategory();
        //获取需要修改试卷的数据
        $ep = new ExamPaper();
        $epId = $request->epId;
        $epData = $ep->where('ep_id', $epId)->first();
        // dd($epData);
        return view('admin.examPaper.updateEp', [ 'tree' => $tree, 'epData' => $epData, 'epId' => $epId ]);
    }

    /**
     * 确认是否删除
     * @param  Request $request 页面用户输入
     * @return view           admin.examPaper.delEpAffirm
     */
  	public function delEpAffirm( Request $request ){
  		$data = $request->all();
  		$epId = $data['epId'];
  		return view( 'admin.examPaper.delEpAffirm', ['epId' => $epId]);
  	}

    /**
     * 删除试卷
     * @param  Request $request 页面用户输入
     * @return redirect           重定向到试卷列表页面 index
     */
  	public function delEp( Request $request ){
  		$data = $request->all();
    	if( is_numeric($data['epId'])){
    		//进行删除操作
            $ep = new ExamPaper();
    		$del_row = $ep
    				 -> where('ep_id', $data['epId'])
    				 -> delete();
    		if( $del_row > 0){
    			//同时删除关联表中的 试卷试题
                $eqr = new EpQtRelation();
    			$rel = $eqr
    				 -> where('ep_id', $data['epId'])
    				 -> delete();
 	  			return redirect('/examPaperList');
    		}else{
    			dd('删除失败');
    		}
    	}

  	}

    /**
     * 公共代码
     * @param  id      传过来的试卷id 
     * @return view        admin.examPaper.epQtList
     */
    private function _epQtList($epId,$qtypeId){
        //获取单个试卷的试卷名称和旗下的试题
        
        //用试卷id查询 试卷 题目 关联表中 试卷旗下的 题目id
        $epr = new EpQtRelation();
        $qtIdData = $epr
                  -> where( 'ep_id', $epId)
                  -> select('qt_id')
                  -> get();
        $qtIds = [];//默认为空数组    
          // dd($qtIdData);    
        if( !empty($qtIdData) ){
            foreach($qtIdData as $k=>$v){
                $qtIds[$k] = $v->qt_id;
            }
        }
        //获取试题
        $qt = new Question;
        $qts = $qt
             -> join( 'gibs_subjects', 'gibs_subjects.sub_id', '=', 'gibs_questions.sub_id' )
             -> join( 'gibs_question_categorys', 'gibs_question_categorys.qc_id', '=', 'gibs_questions.qc_id' )
             -> join( 'gibs_ep_qt_relations', 'gibs_ep_qt_relations.qt_id', '=', 'gibs_questions.qt_id' )
             -> join( 'gibs_question_types', 'gibs_question_types.qtype_id', '=', 'gibs_questions.qtype_id')
             -> where( function( $query ) use( $qtIds ){
                      if( ! empty( $qtIds )){
                          $query->whereIn( 'gibs_questions.qt_id', $qtIds);
                      }else{
                          $query->where( 'gibs_questions.qt_id', 0);
                      }
                 })
             -> where( 'gibs_ep_qt_relations.ep_id', $epId)
             -> where( 'gibs_questions.qtype_id', $qtypeId)
             -> select( 'gibs_questions.*', 'gibs_subjects.sub_id', 'gibs_subjects.sub_title', 'gibs_question_categorys.qc_id', 'gibs_question_categorys.qc_title','gibs_ep_qt_relations.*','gibs_question_types.*')
             -> orderBy( 'gibs_ep_qt_relations.ep_qt_order' )
             -> distinct()
             -> get();
        // dd($qts,$epId,$qtIds,$qtIdData);
        $scoreTotal = 0;
        if( !empty($qts) ){
            foreach($qts as $k=>$v){
                $scoreTotal += $v->qt_score;
            }
        }    
        //获取试卷信息
        $ep = new ExamPaper();
        $epData = \App\ExamPaper::
                   where( 'ep_id',$epId )
                -> select( 'ep_title' )
                -> first();
        //根据题干id，获取题干title
        $qtype = new QuestionType();
        $qtypeTitle = $qtype->where('qtype_id', $qtypeId)->first();
        // dd($qtypeTitle);
        return view( 'admin.examPaper.epQtList', ['epId' => $epId, 'qtypeId' => $qtypeId, 'qtypeTitle' => $qtypeTitle['qtype_title'], 'epData' => $epData,'List' => $qts, 'scoreTotal' => $scoreTotal]);

    }

    /**
     * 题型对应的题目
     * @param  Request $request 传递的id
     * @return view           admin.epQtList
     */
    public function epQtList( Request $request ){
        $data = $request->all();
        $epId = $data['epId'];
        $qtypeId = $data['qtypeId'];

        return $this -> _epQtList($epId,$qtypeId);

    }

    /**
     * 展示 试题排序的页面
     * @param  Request $request 传递的试卷id
     * @return view           admin.examPaper.epQtOrder
     */
    public function epQtOrder( Request $request ){
        $data = $request->all();
        $epId = $data['epId'];
        $qtypeId = $data['qtypeId'];
        //用试卷id查询 试卷 题目 关联表中 试卷旗下的 题目id
        $eqr  = new EpQtRelation();
        $qtIdData = $eqr
                  -> where( 'ep_id', $epId)
                  -> select('qt_id')
                  -> get();
        $qtIds = [];//默认为空数组    
              
        if( !empty($qtIdData) ){
            foreach($qtIdData as $k=>$v){
                $qtIds[$k] = $v->qt_id;
            }
        }

        //获取试题
        $qt  = new Question();
        $qts = $qt
             -> join( 'gibs_subjects', 'gibs_subjects.sub_id', '=', 'gibs_questions.sub_id')
             -> join( 'gibs_question_categorys', 'gibs_question_categorys.qc_id', '=', 'gibs_questions.qc_id')
             -> join( 'gibs_ep_qt_relations', 'gibs_ep_qt_relations.qt_id', '=', 'gibs_questions.qt_id' )
             -> where( function( $query ) use( $qtIds ){
                      if( ! empty( $qtIds )){
                          $query->whereIn( 'gibs_questions.qt_id', $qtIds);
                      }else{
                          $query->where( 'gibs_questions.qt_id', 0);
                      }
                 })
             -> where( 'gibs_ep_qt_relations.ep_id',$epId)
             -> where( 'gibs_ep_qt_relations.qtype_id',$qtypeId)
             -> select( 'gibs_questions.*', 'gibs_subjects.sub_id', 'gibs_subjects.sub_title', 'gibs_question_categorys.qc_id', 'gibs_question_categorys.qc_title','gibs_ep_qt_relations.*')
             -> orderBy( 'gibs_ep_qt_relations.ep_qt_order' )
             -> get();
        return view('admin.examPaper.epQtOrder', ['epId' => $epId, 'qtypeId' => $qtypeId, 'qts' => $qts]);
    }

    /**
     * 处理排序结果
     * @param  Request $request 页面传递的数据
     * @return view           admin.examPaper.epQtList
     */
    public function updateOrder( Request $request ){
        $data = $request->all();
        $epId = $data['epId'];
        $qtypeId = $data['qtypeId'];
       //修改关联表中的排序
        $count = (count($data)-3)/2;
        // dd($data, $count);
        for($i = 0; $i<$count;$i++){
            $qtId = 'qtId'.$i;
            $epQtOrder = 'epQtOrder'.$i;
            $eqr = new EpQtRelation();
            $rel = $eqr
                 -> where('ep_id', $data['epId'])
                 -> where('qtype_id', $qtypeId)
                 -> where('qt_id', $data[$qtId] )
                 -> update([
                    'ep_qt_order' => $data[$epQtOrder]
                 ]);
            
        }
        return $this -> _epQtList($epId, $qtypeId);
    }

    /**
     * 试卷中题目的移除
     * @param  Request $request 页面传递的参数
     * @return view           admin.examPaper.epQtList
     */
    public function delEpQt(Request $request){
      $data = $request->all();
      $epId = $data['epId'];
      $qtypeId = $data['qtypeId'];
      $qtScore = $data['qtScore'];
    	if( is_numeric($data['qtId'])){
    		//进行删除操作
            $eqr = new EpQtRelation();
    		$del_row = $eqr
    				 -> where('qt_id', $data['qtId'])
    				 -> where( 'ep_id', $data['epId'])
    				 -> delete();
            DB::update('update gibs_exam_papers set ep_score_total = ep_score_total-'."$qtScore".' where ep_id ='."$epId");

    		if( $del_row > 0){
    			return $this -> _epQtList($epId, $qtypeId );
    		}else{
    			dd('删除失败');
    		}
    	}
    }

    /**
     * 展示添加试题的页面（从题库中添加题目）    
     * @param Request $request 页面传递过来的参数
     */
    public function addEpQt( Request $request ){
    	$data= $request->all();
    	$epId = $data['epId'];
      $qtypeId = $data['qtypeId'];

    	//用试卷id查询 试卷 题目 关联表中 试卷旗下的 题目id
      $eqr = new EpQtRelation();
    	$qtIdData = $eqr
    			  -> where( 'ep_id', $epId)
    			  -> select('qt_id')
    			  -> get();

    	$qtIds = [];//默认为空数组
    	
    	if( !empty($qtIdData) ){
    		foreach($qtIdData as $k=>$v){
    			$qtIds[$k] = $v->qt_id;
    		}
    	}

    	//获取剩余试题
      $qt  = new Question();
    	$qts = $qt
    		 -> join( 'gibs_subjects', 'gibs_subjects.sub_id', '=', 'gibs_questions.sub_id')
    		 -> join( 'gibs_question_categorys', 'gibs_question_categorys.qc_id', '=', 'gibs_questions.qc_id')
         -> join( 'gibs_question_types', 'gibs_question_types.qtype_id', '=', 'gibs_questions.qtype_id')
    		 -> where( function( $query ) use( $qtIds ){
                      if( ! empty( $qtIds ) ){
                          $query->whereNotIn( 'gibs_questions.qt_id', $qtIds);
                      }
                 })
         -> where( 'gibs_questions.qtype_id', $qtypeId)
    		 -> select( 'gibs_questions.*', 'gibs_subjects.sub_id', 'gibs_subjects.sub_title', 'gibs_question_categorys.qc_id', 'gibs_question_categorys.qc_title')
    		 -> get();
      //遍历查询对应id的数据
      if( !empty($qts) ){
        foreach($qts as $k=>$v){
          $residueIds[$k] = $v->qt_id;
          $eqrData = $eqr->where('gibs_ep_qt_relations.qt_id', $v->qt_id)->orderby('created_at', 'desc')->get();
          $qts[$k]['children'] = $eqrData;
          $qts[$k]['count'] = count($eqrData);
        }
      }
      // dd($qtIdData,$qts,$qtIds,$residueIds);
      // dd($qts);
      //从试卷题目关联表中获取 题目 的使用次数
      // $eqrData = $eqr-> join('gibs_question_types', 'gibs_question_types.qtype_id', '=', 'gibs_ep_qt_relations.qtype_id') 
      //                -> where( function( $query ) use( $residueIds ){
      //                       if( ! empty( $residueIds ) ){
      //                           $query->whereIn( 'gibs_ep_qt_relations.qt_id', $residueIds);
      //                       }
      //                  })
      //                -> get();
      // dd($eqrData,$residueIds); 
    	//获取科目id title
      $sub = new Subject();
    	$subs = $sub->get();

    	return view('admin.examPaper.addEpQt', ['epId' => $epId, 'qtypeId' => $qtypeId, 'qts' => $qts, 'subs' => $subs]);
    	// dd($epId);
    }


    /**
     * 题库中题目的搜索功能
     * @param  Request $request 页面用户输入
     * @return view           admin.examPaper.addEpQt
     */
    public function epQtSelect( Request $request ){
    	$data = $request->all();
    	$subId = is_numeric($data['subId']) ? $data['subId']:''; //用三目运算来确定有没有选择科目
        
        $epId = $data['epId'];
        $qtypeId = $data['qtypeId'];
        //用试卷id查询 试卷 题目 关联表中 试卷旗下的 题目id
        $eqr = new EpQtRelation();
        $qtIdData = $eqr
                  -> where( 'ep_id', $epId)
                  -> select('qt_id')
                  -> get();

        $qtIds = [];//默认为空数组
        
        if( !empty($qtIdData) ){
            foreach($qtIdData as $k=>$v){
                $qtIds[$k] = $v->qt_id;
            }
        }

        $qt  = new Question();
    	$qts = $qt
             -> join('gibs_question_categorys', 'gibs_question_categorys.qc_id', '=', 'gibs_questions.qc_id')
             -> join('gibs_subjects', 'gibs_subjects.sub_id', '=', 'gibs_questions.sub_id')
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
             -> where( function( $query ) use( $qtIds ){
                  if( ! empty( $qtIds ) ){
                      $query->whereNotIn( 'gibs_questions.qt_id', $qtIds);
                  }
             })
             -> where( 'gibs_questions.qtype_id', $qtypeId)
             -> select('gibs_questions.*','gibs_subjects.sub_title','gibs_subjects.sub_id','gibs_question_categorys.qc_title','gibs_question_categorys.qc_title')
             -> get();
      //遍历查询对应id的数据
      if( !empty($qts) ){
        foreach($qts as $k=>$v){
          $residueIds[$k] = $v->qt_id;
          $eqrData = $eqr->where('gibs_ep_qt_relations.qt_id', $v->qt_id)->orderby('created_at', 'desc')->get();
          $qts[$k]['children'] = $eqrData;
          $qts[$k]['count'] = count($eqrData);
        }
      }
        //获取科目id  title
        $sub = new Subject();
        $subs = $sub
              -> select('sub_id', 'sub_title')
              -> get();
              
        $subTitle = $sub->where('sub_id', '=', $subId)->select('sub_title')->first();

        return view('admin.examPaper.addEpQt', ['epId' => $data['epId'], 'qtypeId' => $qtypeId, 'qts' => $qts,'subs' => $subs,'subId' => $subId, 'subTitle' => $subTitle, 'qtTitle' => $data['qtTitle']]);
    }

    /**
     * 加入试卷
     * @param  Request $request 页面传递的参数
     * @return view           admin.addEpQt
     */
    public function joinEp( Request $request ){
    	$data    = $request->all();
      $qtScore = $data['qtScore'];
		  $epId = $data['epId'];

      //根据试卷id获取试卷的用途 
      $ep    = new ExamPaper();
      $epUse = $ep->where('ep_id', $epId)->select('ep_use')->first();
      // $use = $epUse['ep_use'];
      $use   = $epUse->ep_use;

      $eqr   = new EpQtRelation();
      $eqr->ep_id    = $data['epId'];
      $eqr->qt_id    = $data['qtId'];
      $eqr->qtype_id = $data['qtypeId'];
      $eqr->ep_use   = $use;
      $insertBool    = $eqr->save();

      
      //试卷表中的总分进行累加
      DB::update('update gibs_exam_papers set ep_score_total = ep_score_total+'."$qtScore".' where ep_id ='."$epId");
  
      //用试卷id查询 试卷 题目 关联表中 试卷旗下的 题目id
      $qtIdData = $eqr
            -> where( 'ep_id', $epId)
            -> select('qt_id')
            -> get();
      foreach($qtIdData as $k=>$v){
        $qtIds[$k] = $v->qt_id;
      }

      //获取试题    
      $qt  = new Question(); 
    	$qts = $qt
    		 -> join( 'gibs_subjects', 'gibs_subjects.sub_id', '=', 'gibs_questions.sub_id')
    		 -> join( 'gibs_question_categorys', 'gibs_question_categorys.qc_id', '=', 'gibs_questions.qc_id')
         -> join( 'gibs_question_types', 'gibs_question_types.qtype_id', '=', 'gibs_questions.qtype_id')
    		 -> whereNotIn( 'gibs_questions.qt_id', $qtIds)
         -> where( 'gibs_questions.qtype_id', $data['qtypeId'])
    		 -> select( 'gibs_questions.*', 'gibs_subjects.sub_id', 'gibs_subjects.sub_title', 'gibs_question_categorys.qc_id', 'gibs_question_categorys.qc_title')
    		 -> get();
         
      //遍历查询对应id的数据
      if( !empty($qts) ){
        foreach($qts as $k=>$v){
          $residueIds[$k] = $v->qt_id;
          $eqrData = $eqr->where('gibs_ep_qt_relations.qt_id', $v->qt_id)->orderby('created_at', 'desc')->get();
          $qts[$k]['children'] = $eqrData;
          $qts[$k]['count'] = count($eqrData);
        }
      }
    	//获取科目id title
        $sub  = new Subject();
    	$subs = $sub->get();
    				
    	return view('admin.examPaper.addEpQt', ['epId' => $epId, 'qtypeId' => $data['qtypeId'], 'qts' => $qts, 'subs' => $subs]);
    }



}
