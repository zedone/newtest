<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate{

	protected $rule=[
        'name'=>'require|max:25',
        'password'=>'require|min:5',
    ];
    protected $message=[
        'name.require'=>'管理员名称不能为空',
        'name.unique'=>'管理员名称不能重复',
        'name.max'=>'管理员名称不能大于25位',
        'password.require'=>'密码必须填写',
        'password.min'=>'密码不得少于5位'
    ];
}