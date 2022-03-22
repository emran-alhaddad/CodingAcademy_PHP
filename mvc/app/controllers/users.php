<?php
require_once 'controller.php';
class Users extends Controller{
    public function __construct()
    {


    
        echo "<h1>inside users controller construct</h1>";
        
    }
    function index(){

        echo "<h1>index of users</h1>";

    }
    function show($id){
        

        $user=$this->model('user');
        $userName=$user->select($id);
        $this->view('user_view',$userName);

    }
    function add(){

        echo "<h1>add of users</h1>";

    }
    function listAll(){

    }
}
?>