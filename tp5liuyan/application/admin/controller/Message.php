<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
use app\admin\model\Message as Admessage;
class Message extends Base
{
    public function index()
    {

    	if(request()->isPost()){
            $userid = session('id');
            $data = [
                'message' => input('message'),
                'userid' => $userid,
            ] ;         
           
    		$tianmessage = new Admessage();
    		$res = $tianmessage->addmessage($data);
    		if($res){
    			$this->success('success message',url('Message/index'));
    		}else{
    			$this->error('failed');
    		}
    		return;
    	}

        return $this->fetch();
    }

   public function lst()
    {
        //$message = Db::name('message')->select();
        // $message = Db::name('message')->alias('m')->join('admin a','a.id=m.userid')->field('m.id,m.userid,m.message,a.name')->order('m.id desc')->select();
        //dump($message);die;
        $lists = new Admessage();
        $message = $lists->lists();
        $this->assign('message',$message);
        return $this->fetch();
    }

    public function edit(){
        $id = input('id');
        $mess = new Admessage();
        $mess = $mess->mlists($id);
        if(request()->isPost()){

            $data = [
                //'id' => input('userid'),
                'message' => input('message'),
            ];
           // echo session('id');
            //dump($mess['userid']);die();
            if(session('id')!==$mess['userid']){
                $this->error('不能修改他人信息','lst');
            }
            //dump($data);die();
            if($mess->editmessage($data)){
                $this->success('success','lst');
            }else{
                $this->error('fail');
            }
            return;
        }
        $this->assign('mess',$mess);
        return $this->fetch('edit');
    }

    public function del($id){
        $id = input('id');
        if(db('message')->delete($id)){
                $this->success('success','lst');
        }else{
                $this->error('fail');
            
        }
    }
}
