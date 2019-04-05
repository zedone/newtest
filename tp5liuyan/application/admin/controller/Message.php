<?php
namespace app\admin\controller;
use think\Db;
use app\admin\controller\Base;
use app\admin\model\Message as MessageModel;
use app\admin\model\Cate as CateModel;
class Message extends Base
{
    public function index()
    {

    	if(request()->isPost()){
            $userid = session('id');
            $data = [
                'message' => input('message'),
                'userid' => $userid,
                'cid'   => input('cid'), 
            ] ;         
           
    		$tianmessage = new MessageModel();
    		$res = $tianmessage->addmessage($data);
    		if($res){
    			$this->success('success message',url('Message/index'));
    		}else{
    			$this->error('failed');
    		}
    		return;
    	}     
        $cate = new CateModel();
        $cates = $cate->catetree();       
        $this->assign('cates',$cates);
        return $this->fetch();
    }

   public function lst()
    {
        $lists = new MessageModel;
        $message = $lists->lists();
        $this->assign('message',$message);
        return $this->fetch();
    }

    public function edit(){
        $id = input('id');
        echo $id."<br>";
        echo session('id');
        $mess = new MessageModel; 
        $mess = $mess->mlists($id);
        //dump($mess['id']);die();
        if(request()->isPost()){
            $data = [
                //'id' => input('userid'),
                'catename' => input('cid'),
                'message' => input('message'),
            ];
            if(session('id')!==$mess['userid']){
                $this->error('不能修改他人信息','lst');
            }

            if($mess->editmessage($data)){
                $this->success('success','lst');
            }else{
                $this->error('fail');
            }
           // return;
        }
        $this->assign('mess',$mess);
        // $cate = new CateModel();
        // $cateres= $cate->lists();
        // $this->assign('cateres',$cateres);
        return $this->fetch();
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
