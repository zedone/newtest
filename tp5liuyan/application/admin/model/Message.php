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
}