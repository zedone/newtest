<?php
namespace app\admin\model;
use think\Db;
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
		$res = $this->find($id);
		return $res;
	}

	public function editmessage($data){
		$result = $this->save($data);
		return $result;
	}

	public function lists(){
		$message = $this->alias('m')->join('admin a','a.id=m.userid')->field('m.id,m.userid,m.message,a.name')->order('m.id desc')->select();
		return $message;
	}
}