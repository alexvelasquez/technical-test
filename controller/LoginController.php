<?php
include_once('model/User.php');
class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        /** user is logged */
        session_start();
        if(!empty($_SESSION['login'])){
            header("Location: ".base_url().'/user/home');
        }
    }
    public function index()
    {
        return $this->views->getView('Login'); 
    }

    public function login()
    {
        $user = !empty($_POST['username']) ? $_POST['username'] : null;
        $password = !empty($_POST['password']) ? hash("SHA256",$_POST['password']) : null;
        /** check data */
        if(empty($user) || empty($password))
        {
            echo json_encode(['code'=>400,'error'=>'Invalid Parameters']);die;
        }
        /** find user in database */
        $response = User::findOneBy(['username'=>$user,'password'=>$password]);
        if(empty($response))
        {
            echo json_encode(['code'=>403,'error'=>'Invalid credentials']);die;
        }
        /** set session */
        $_SESSION['id']=$response->getId();
        $_SESSION['username']=$response->getUsername();
        $_SESSION['login']=true;
        echo json_encode(['code'=>200,'data'=>'successful login']);die;
    }
}