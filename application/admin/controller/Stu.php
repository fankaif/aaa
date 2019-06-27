<?php
namespace app\admin\controller;


class Stu extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $arr=input('get.');
        $data=[];
        $where=[];
        if(!empty($arr['name'])){
            $data['name']=$arr['name'];
            $where['name']=['like',"%".$arr['name']."%"];
        }
        // $arr=db('user')->where('name','like','%李%')->order('id desc')->paginate(5);
        $arr=db('user')->where($where)->order('id desc')->paginate(5,false,['query'=>$data]);

        return view('',['arr'=>$arr]);
    }

    /**
     * 显示添加表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('add');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        // dump(input('get.'));
        $arr=input('get.');
        unset($arr['file']);
        $result=db('user')->insert($arr);
        return $result;
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $arr=db('user')->find($id);
        return view('',['arr'=>$arr]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        // dump(input('get.'));
        $arr=input('get.');
        $result=db('user')->update($arr);
        return $result;
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result=db('user')->delete($id);
        return $result;
    }


    // 指定文件上传的方法
    public function upload(){
        // dump(input('file.'));
        $file = request()->file('file');
        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static/uploads/stu');
       if($info){
            //返回json格式
            return json(['code'=>0,'msg'=>'','data'=>['src'=>'/static/admin/user/'.$info->getFilename(),'title'=>$info->getFilename()]]);
        }else{
            // 上传失败获取错误信息
            return json(['code'=>1,'msg'=>$file->getError(),'data'=>[]]);
        }

    }
}
