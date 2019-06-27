<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User as U;
use app\index\model\Shuxue as S;
use app\index\model\Yuwen as Y;


class Index extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }

    public function add(){
    	$user=new U;
    	$user->name='李四';
    	$user->sex='w';
    	$user->age=100;
    	$user->class='28班';
    	if($user->save()){
    		$s =new S;
    		$s->s_fenshu=100;
    		$user->shuxue()->save($s);
    	}
    }

    public function read(){
    	$user =new U;
    	$arr=$user->get(179);
    	// echo "<pre>";
    	$fenarr=$arr->yuwen;
    	// echo $arr->name."<br>";
    	// echo $arr->sex."<br>";
    	// echo $arr->shuxue->s_fenshu."<br>";
    	return view('read',['array'=>$arr,'fenarr'=>$fenarr]);
    }

    public function update(){
    	$user=new U;
    	$arr=$user->get(179);
    	$arr->name="田七";
    	if ($arr->save()) {
    		$arr->shuxue->s_fenshu=750;
    		$arr->shuxue->save();
    	}
    }

    public function delete(){
    	$user= new U;
    	$arr=$user->get(166);
    	$arr->delete();
    	$arr->shuxue->delete();
    }
}
