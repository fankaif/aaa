<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // echo "111";
        // die;
        return view('index');
    }

    public function welcome()
    {
    	return view();
    }
}
