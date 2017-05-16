<?php 
  
namespace app\admin\crontroller;


use think\Controller;
class Login extends Controller
{

   public function index ()
    {


        // if (D("Admin/Admin")->isLogin()) {
        //     $this->redirect ("Admin/Nodes/index" );
        // }

        $this->fetch("login");
    }
    
    /**
     * 登录操作
     */
    public function login()
    {
        $username = trim(I("post.username"));
        $password = trim(I("post.password"));
        
        if (empty($username)) {
            $data['error_code'] = 1;
            $data['message'] = "请填写用户名！";
            $this->ajaxReturn($data);
        }
        if (empty($password)) {
            $data['error_code'] = 1;
            $data['message'] = "请填写密码！";
            $this->ajaxReturn($data);
        }
        
        $res = D("Admin/Admin")->doLogin($username, $password);
        if ($res) {
            $data['error_code'] = 0;
            $data['message'] = "登录成功";
        } else {
            $data['error_code'] = 1;
            $data['message'] = "登录失败";
        }
        $data['url']=U('Admin/Nodes/index');
        
        $this->ajaxReturn($data);
    }
    
    /**
     * 退出登录
     */
    public function logout()
    {
        D("Admin/Admin")->doLogout();
        $this->redirect ("Admin/Login/index" );
    }
}