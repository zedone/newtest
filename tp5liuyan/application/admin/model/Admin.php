<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Admin extends Model{
	  const LOGIN_FAIL=1;
	  const LOGIN_SUCCESS=2;
	  const LOGIN_PASSWORD_ERROR=3;
	  public static $msgMap = array(
	  		self::LOGIN_FAIL => array('text'=>'登陆失败'),
	  		self::LOGIN_PASSWORD_ERROR => array('text'=>'密码错误'),
	  		self::LOGIN_SUCCESS => array('text'=>'登录成功'),
	  	);
	public function addadmin($data){
		return $this->save($data);
	}

	public function login($data){
		$result = array(
			'error'=>self::LOGIN_SUCCESS,
			'msg' => self::$msgMap[self::LOGIN_SUCCESS],
			);
		//$admin = Admin::getByName($data['name']);
		$admin=$this->where('name',$data['name'])->find();
		if($admin){	
			if($admin['password']==$data['password']){
				\think\Session::set('id',$admin['id']);
				\think\Session::set('name',$admin['name']);
				$result['error'] = self::LOGIN_SUCCESS;
				$result['msg'] = self::$msgMap[2]['text'];
				return $result;
				//dump($result);die();
			}else{
				$result['error'] = self::LOGIN_PASSWORD_ERROR;
				$result['msg'] = self::$msgMap[3]['text'];
				//$result = implode(' ',$result);
				return $result;
				//dump($result);die();
			}
		}else{
			$result['error'] = self::LOGIN_FAIL;
			$result['msg'] = self::$msgMap[1]['text'];
			//$result = implode(' ',$result);
			return $result;
			//dump($result);die();
		}
	}

	public function lists(){
		$info =  $this->select();
		//$info = $info->toArray();
		//dump($info);die();
		
		return $info;
	}

	public function del($id){
		$info = $this->where('id',$id)->delete($id);
		//dump($info);die;
		return $info;
	}
}

	  // public function chen(){
   //      $redis = new \Redis();
   //      $redis->connect('192.168.199.249','6379');
   //      $key = "user_info_{$id}";
   //      $info = $redis->get($key);
   //      if(empty($info)){
   //          $info = $this->where('id',$id)->find();
   //          $info = $info->toArray();
   //          $info = serialize($info);
   //          $redis->setex($key,600,$info);
   //      }
   //      $info = unserialize($info);
   //      return $info;
   //  }