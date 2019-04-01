<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Cate as CateModel;
use think\Db;
class Cate extends Base{
	protected $beforeActionList = [
      	//如果执行del 先执行delonly
        'delonly'  =>  ['only'=>'del'],
    ];
	public function first(){
		echo '111';die;
	}
	public function add(){
		if(request()->isPost()){
			$data = input('post.');
			
			if(db('cate')->insert($data)){
				return $this->success('添加栏目成功','lst');
			}else{
				return $this->error('添加栏目失败');
			}
			return;
		}
		$cate = new CateModel();
		//$cateres = Db::name('cate')->select();
		
		$cates = $cate->catetree();
        //dump($adminers);die;
        $this->assign('cates',$cates);
		return $this->fetch();
	}

	public function lst(){
		
		$cates = Db::name('cate')->select();
		$cate = new CateModel();
		
		$cates = $cate->catetree();
        //dump($cates);die;
        $this->assign('cates',$cates);
		return $this->fetch();
	}

	public function del(){
		$del = db('cate')->delete(input('id'));
		if($del){
			$this->success('success','lst');
		}else{
			$this->error('fail');
		}
	}

	public function delonly(){
		//要删除的当前栏目id
		$cateid=input('id');
		$cate = new CateModel;
		$sonid = $cate -> getchildrenid($cateid);
		//dump($sonid);die;
		if($sonid){
			db('cate')->delete($sonid);
		}
	
	}
}