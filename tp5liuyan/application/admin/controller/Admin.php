<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;
use app\admin\model\Admin as login;
class Admin extends Base
{
    public function test(){
        $a = array(1,3,4,5,8,6,2);
        $res = array();
        $count = count($a);
        echo $count;
        for($i=0;$i<$count;$i++){
            $b = array_shift($a);
            $c = 7-$b;
            $d = in_array($c,$a);
            if($d){
                $res[] = $b.'=>'.$c;
            }
        }
        dump($res);
        
    }

    public function test7(){
        $a = array(1,3,4,5,8,6,2);
        $tmp = array();
        //$len = count($a);
        $res = array();
        foreach ($a as $v) {
            $tmp[$v]=1;
        }
        dump($tmp);
        foreach ($tmp as $k => $value) {
            $v = 7-$k;
            //$len = count($a);
            //$c = in_array($v,$tmp);        
            if(isset($tmp[$v])){
                $res[] = $k.'=>'.$v;
                unset($tmp[$v]);
                unset($tmp[$k]);
            }
        }
        dump($res);
    }

    public function zhan(){
        $arr = array('('=>')','['=>']','{'=>'}');
        $c = '{[()]}';
        $b = str_split($c);
        $s = array();
        $left = array_keys($arr);
        $right = array_values($arr);
        foreach ($b as $value){
            if(in_array($value,$left)){
                //$tmp[]= $value;
                dump($value);
                array_push($s, $arr[$value]);

            }
            elseif(in_array($value,$right)){
               // dump($value);
                dump($s);
                if($value != array_pop($s)){echo '匹配失败';break;}
            }
        }
        if(empty($s)){
            echo "成功";
        }
 
    }

    public function duilie(){
        $arr1 = array();
        $arr2 = array();
        $tmp = array();
        for($i=0;$i<10;$i++){
            $count = array_push($arr1,$i);
            if($count == 4){
                for($j=0;$j<4;$j++){
                    $arr2[] = array_pop($arr1);
                }
                //dump($arr2);
                dump($arr2);
                for($j=0;$j<4;$j++){
                    $tmp[] = array_pop($arr2);
                }
                dump($tmp);
            }
        }
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

    public function myRedis(){
        $id = session('id');
        $myredis = new login;
        $result = $myredis->getInfoByIdv1($id);
        dump($result);
    }

}
