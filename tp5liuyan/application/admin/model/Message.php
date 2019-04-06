<?php
namespace app\admin\model;
use think\Model;

class Message extends Model{

	public function addmessage($data){

		if($this->save($data)){
			return true;
		}else{
			return false;
		}
	}


	public function editadmin($data){
		if($this->save($data)){
			return true;
		}else{
			return false;
		}
	}

	public function mlists($id){
		$res = $this->where('id',$id)->find();
		return $res;
	}

	public function editmessage($data){
		$result = $this->save($data);
		return $result;
	}

	public function lists(){
		$message = $this->alias('m')->field('m.id as mid,c.id as cateid,a.id as aid,m.*,c.id,c.catename,a.id,a.name')->join('cate c','m.cid=c.id','LEFT')->join('admin a','m.userid=a.id')->select();
		return $message;
		// $Data  =  M('a')->where($where)
  //                           ->Field('a.name as aname,b.name as uname,a.*')
  //                           ->join('b on b.jb_id=a.id','LEFT')
  //                           ->order('a.id desc')
  //                           ->select()

	}
}