<?php
namespace app\index\controller;

use think\Db;

class Index extends Common
{
    public function index()
    {

        return $this->fetch();
    }

    public function test()
    {

        $data = $this->params;
        $user = db('teach')->where('username', $data['username'])->select();
        if ($user) {
            $this->return_msg(200, '返回成功', $user);

        } else {
            $this->return_msg(400, '数据不存在');

        }

    }
}
