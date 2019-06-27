<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class User extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(){
        // 定义两个空数组
        $data = [];
        $where= [];
        $b = input('get.name');
        if (!empty($b)) {
            $data['name']=input('get.name');
            $where['name']=['like','%'.$data['name'].'%'] ;
        }
        $user=Db::table('user')->where($where)->order('id desc')->paginate(5,false,['query'=>$data]);
        return view('',['user'=>$user,'list']);
    }

    // 执行删除
    public function delete($id){
        $result=Db::table('user')->delete($id);
        return $result;
    }

    // 执行更改
    public function update(){
        $arr=(input('get.'));
        $result=Db::table('user')->update($arr);
        return $result;
    }

    // 跳转添加页面
    public function add(){
        return view();
    }
    // 执行添加
    public function insert(Request $request){
        $arr=input('get.')['data'];
        $result=db('user')->insert($arr);
        return $result;
    }

    // 加载修改页面
    public function edit($id){
        $arr=db('user')->find($id);
        return view('',['arr'=>$arr]);
    }

    // 执行上传
    public function upload($filed='file')
    {
        $file = request()->file($filed);
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . '/static/admin/user');
        if($info){
            //返回json格式
            return json(['code'=>0,'msg'=>'','data'=>['src'=>'/static/admin/user/'.$info->getFilename(),'title'=>$info->getFilename()]]);
        }else{
            // 上传失败获取错误信息
            return json(['code'=>1,'msg'=>$file->getError(),'data'=>[]]);
        }
    }


}
