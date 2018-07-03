<?php
/**
 *
 */

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Validate;

class Common extends Controller
{

    protected $request; //用来处理参数
    protected $Validates; //用来验证的数据或者是参数
    protected $params; //过滤后符合要求的参数
    protected $rules = array(
        'User' => array(
            'login' => array(
                'username' => ['require', 'chsDash', 'max' => 20],
                'userpwd' => 'require|length:32',
            ),
        ),
        'Index' => array(
            'index' => array(

            ),
            'test' => array(

            ),
        ),

    );
    protected function _initialize()
    {
        parent::_initialize();
        $this->request = Request::instance();
        // $this->check_time($this->request->only(['time']));
        // $this->check_token($this->request->param());
        $this->params = $this->check_params($this->request->except(['time', 'token']));
    }

    /*
    验证请求是否超时
     */
    public function check_time($arr)
    {
        if (!isset($arr['time']) || intval($arr['time']) <= 1) {
            $this->return_msg(400, '时间戳不存在');
        }
        if (time() - intval($arr['time']) > 60) {
            $this->return_msg(400, '请求超时');
        }
    }
    /*
    返回错误信息
     */

    public function return_msg($code, $msg = '', $data = [])
    {
        // 组合数据
        $return_data['code'] = $code;
        $return_data['msg'] = $msg;
        $return_data['data'] = $data;
        // 返回信息并终止脚本
        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);die;
    }
    /*
    验证token
     */
    public function check_token($arr)
    {
        if (!isset($arr['token']) || empty($arr['token'])) {
            $this->return_msg('400', 'token 不能为空');
        }

        $app_token = $arr['token']; //api 穿过来的token

        unset($arr['token']); //除了token以外的值进行加密所以剔除token值
        $service_token = '';
        foreach ($arr as $key => $value) {
            $service_token .= md5($value);
        }
        $service_token = md5('api_' . $service_token . '_api'); // 服务器生成的api

        if ($app_token !== $service_token) {

            $this->return_msg('400', 'token值不正确');
        }
    }

    public function check_params($arr)
    {

        // 获取数据的验证规则
        $rule = $this->rules[$this->request->controller()][$this->request->action()];
        // 验证参数并返回错误
        $this->Validates = new Validate($rule);
        if (!$this->Validates->check($arr)) {
            # code...
            $this->return_msg(400, $this->Validates->GetError());
        }
        // 如果正常通过验证
        return $arr;

    }

    public function check_username($username)
    {
        /*验证是否为邮箱*/
        $is_email = Validate::is($username, 'email') ? 1 : 0;
        // 验证是否为手机号

        $is_phone = preg_match('/^1[34578]\d{9}$/', $username) ? 4 : 2;
        // 最终结果
        $flag = $is_email + $is_phone;
        switch ($flag) {
            case '2':
                $this->return_msg(400, '既不是邮箱也不不是手机');
                break;
            case '3':

                return 'email';
                break;

            case '4':
                return 'phone';
                break;

        }
    }

    // 判断用户名（手机/邮箱）是否存在
    public function check_exist($value, $type, $exist)
    {
        $type_num = $type == "phone" ? 2 : 4;
        $flag = $type_num + $exist;
        $phone_res = db('user')->where('user_phone', $value)->find();
        $email_res = db('user')->where('user_email', $value)->find();

        switch ($flag) {
            case '2':
                if ($phone_res) {
                    $this->return_msg(400, '此手机号已经使用');
                }
                break;
            case '3':
                if (!$phone_res) {
                    $this->return_msg(400, '此手机号不存在');
                }
                break;

            case '4':
                if ($email_res) {
                    $this->return_msg(400, '此邮箱已经使用');
                }
                break;

            case '5':
                if (!$email_res) {
                    $this->return_msg(400, '此邮箱不存在');
                }
                break;

        }
    }

}
