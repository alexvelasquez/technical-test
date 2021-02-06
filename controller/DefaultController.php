<?php 
class DefaultController extends Controller{
    public function __construct()
    {   session_start();
        parent::__construct();
    }

    public function index()
    {
        if(isset($_SESSION['login'])){
            header("Location: ".base_url().'/user/home');
        }
        header("Location: ".base_url().'/login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: ".base_url().'/login');
        exit();
    }
}