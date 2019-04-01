<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin ;
class Login extends Controller{

	public function index(){
		if(request()->isPost()){
			$admin = new Admin();
			$data = input('post.');
			//dump($data);die;
			$result = $admin->login($data);
			if($result['error']==Admin::LOGIN_SUCCESS){
				$this->success($result['msg'],url('admin/lst'));
			}else{
				$this->error($result['msg']);
			}			
			return;
		}

	}


	public function logout(){
		session(null);
		return $this->success('退出成功',url('Login/index'));
	}
	
}