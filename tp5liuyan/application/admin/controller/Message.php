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
        $message = Db::name('message')->alias('m')->join('admin a','a.id=m.userid')->field('m.id,m.userid,m.message,a.name')->order('m.id desc')->select();
        //dump($message);die;
        $this->assign('message',$message);
        return $this->fetch();
    }

    public function edit(){
        $id = input('id');
        //  echo $id;
        $mess = Db::table('message')->find($id);
        //dump($mess);die;
        if(request()->isPost()){
            $data = input('post.');

            //dump($data);die;
            if(db('message')->update($data)){
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
