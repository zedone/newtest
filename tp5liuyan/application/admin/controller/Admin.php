<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
use app\admin\model\Admin as login;
class Admin extends Base
{
    public function cyx(){
        $redis = new \Redis();
        $redis->connect('192.168.199.249','6379');
        $redis->set('name','chenyx');
       // $name = $redis->get('name');

    }
    public function add()
    {
    	//判断是否是post表单提交
    	if(request()->isPost()){
    		$data = input('post.');
    		//验证
    		$validate=\think\Loader::validate('Admin');
    		if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());die;
            }

    		$adadmin = new login();
    		$list = $adadmin->addadmin($data);
    		if($list){
    			$this->success('success admin',url('add'));
    		}else{
    			$this->error('failed');
    		}
    		return;
    	}
    	if(request()->isPost()){
    		$adadmin = new login();
    		$list = $adadmin->addadmin();
    		//dump($list);die;
    	}
    
        return $this->fetch();
    }

    public function lst(){
        $lsts = new login(); 
        $adminers = $lsts->lists();
        //dump($adminers);die;
        $this->assign('adminers',$adminers);


        return $this->fetch();
    }

    public function del(){
        $id=input('id');
        //dump($id);die;
        $dels = new login();
        $infos = $dels->del($id);
        if($infos){
                $this->success('删除管理员成功','lst');
            }else{
                $this->error('删除管理员失败');
            
        }
    }

}
