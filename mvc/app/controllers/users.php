<?php
require_once 'controller.php';
require_once 'app/system/validation.php';
class Users extends Controller
{
    public function __construct()
    {

        echo "<h1>inside users controller construct</h1>";
    }
    function index()
    {

        echo "<h1>index of users</h1>";
    }
    function show($id)
    {


        $user = $this->model('user');
        $userName = $user->select($id);
        $this->view('user_view', $userName);
    }
    function add()
    {

        echo "<h1>add of users</h1>";
    }

    function add_user()
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['name'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $reTypePassword = $_POST['retype_password'];

            $data = array(
                'name' => ["data"=>$userName, "required"=> true],
                'password' => ["data"=>md5($password), "required"=> true , "min"=>5 , "max"=>15],
                'email' => ["data"=>$email, "required"=> true],
                'repass' => ["data"=>$reTypePassword, "required"=> true],
            );

            if (Validation::validateUser($data)) {

                if ($userName != "" && $password != "" && $email != "") {
                    $user_data = array(
                        'name' => $userName,
                        'password' => md5($password),
                        'email' =>$email,
                        'repass' => $reTypePassword,
                    );
                    $u = $this->model('user');
                    $message = "";
                    if ($u->insert($user_data)) {
                        $type = 'success';
                        $message = "user created successful";
                        $this->view('feedback', array('type' => $type, 'message' => $message));
                    } else {
                        $type = 'danger';
                        $message = "can not create user please check your data ";

                        $this->view('register', array('type' => $type, 'message' => $message, 'form_values' => $_POST));
                    }
                }
            }
            else
            {
                $type = 'danger';
                $message = "can not create user please check your data ";

                $err = array(
                'nameErr' => Validation::$userNameError,
                'passErr' => Validation::$passwordError,
                'rePassErr' => Validation::$rePasswordError,
                'emailErr' => Validation::$emailError
                );
                $this->view('register', array('type' => $type, 'message' => $message, 'form_values' => $_POST , 'Errors' => $err));
            }
        }
    }
    function register()
    {
        $this->view('register');
    }

    function list_all()
    {
        $users = $this->model("user");
        $result = $users->select();
        $this->view('users_table', $result);
    }
    function status($id)
    {
        $user = $this->model("user");
        $user->changeStatus($id);
        $this->list_all();

        //        header('location:users/list_all');



    }
}
