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
		$message = $this->alias('m')->join('admin a','a.id=m.userid')->join('cate c','c.id=m.cid')->select();
		return $message;
	}
}