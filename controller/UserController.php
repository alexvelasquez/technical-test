<?php
include_once('model/User.php');
class UserController extends Controller{
    public function __construct()
    {
        parent::__construct();
        /** user is logged */;
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".base_url().'/login');
        }
    }

    /* Method={Get}
       Descrption= view list users **/
    public function home()
    {
        $users = User::findAll();
        return $this->views->getView('Home',['title'=>'Section users',
                                             'users'=>$users]);
    }

     /* Method={Get}
       Descrption= view new user **/
    public function new()
    {
        return $this->views->getView('FormUser',['title'=>'New user']);
    }

    /*  Method={Post}
        Descrption= create new user **/
    public function newUser()
    {
        try {
           $data = array(
                        'name' => $_POST['name'] ?? null,
                        'last_name'=> $_POST['last_name'] ?? null,
                        'username'=>$_POST['username'] ?? null,
                        'email'=>$_POST['email'] ?? null,
                        'password'=>$_POST['password'] ? hash("SHA256",$_POST['password']) : null,
                        'created_at'=>(new \DateTime())->format('Y-m-d H:m:s'),
                        'updated_at'=>(new \DateTime())->format('Y-m-d H:m:s'),
                    );
            $validate = $this->validateForm($data);
            if(!$validate){
                $this->jsonResponse(400,'Invalid params');
            }

            $dataValidateUser = ['username'=>$data['username'], 'email'=>$data['email']];
            $userExists= User::userExists($dataValidateUser);
            if(!empty($userExists)){
                $this->jsonResponse(404,'User exists');
            }
            $newUser = User::persist($data);
            if($newUser){
                $this->jsonResponse(200,'User created');
            }
        } catch (\Exception $e) {
            $this->jsonResponse(500,'An error has occurred');
        }
    }
    /* Method={Get}
       Descrption= view edit user **/
    public function edit($id)
    {   
        $user = User::findOneBy(['id'=>$id]);
        return $this->views->getView('FormUser',['title'=>$user->getName().' '.$user->getLastName(),
                                                 'user'=>$user]);
    }

    /* Method={PUT}
       Descrption= edit user **/
    public function editUser($id)
    {   
        try {
            $data = array(  'id'=> $id ?? null,
                            'name' => $_POST['name'] ?? null,
                            'last_name'=> $_POST['last_name'] ?? null,
                            'username'=>$_POST['username'] ?? null,
                            'email'=>$_POST['email'] ?? null,
                            'updated_at'=>(new \DateTime())->format('Y-m-d H:m:s'),
                    );
            $validate = $this->validateForm($data);
            if(!$validate){
                $this->jsonResponse(404,'Invalid params');
            }

            $user= User::findOneBy(['id'=>$id]);
            if(!$user){
                $this->jsonResponse(404,'User not exists');
            }
            $dataValidateUser = ['username'=>$data['username'], 'email'=>$data['email']];
            $userExists= User::userExists($dataValidateUser,$user);
            if(!empty($userExists)){
                $this->jsonResponse(404,'User exists');
            }

            $user = User::persist($data);
            if($user->getId()){
                $this->jsonResponse(200,'User updated');
            }
        } catch (\Exception $e) {
            $this->jsonResponse(200,'An error has occurred');
        }
    }

    /* Method={DELETE}
    Descrption= delete user **/
    public function delete($id)
    {   
        try {
            $user= User::findOneBy(['id'=>$id]);
            if(!$user){
                $this->jsonResponse(404,'User not exists');
            }
            $user = User::delete($id);
            if($user){
                $this->jsonResponse(200,'User deleted');
            }
        } catch (\Exception $e) {
            $this->jsonResponse(200,'An error has occurred');
        }
    }
}