<?php
class User{

    function insert(){
        echo "insert function of user model";
    }

    function select($id){
        $all_users=array('ahmed','afnan','ali','baabood');
        if($id>sizeof($all_users)-1)
        return "incorrect user id ";
        return $all_users[$id];
       
    }
}
?>