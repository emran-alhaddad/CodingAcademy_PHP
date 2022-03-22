<?php
class User{
    public $pdo;


    public function __construct(){

        $dsn='mysql:hostname=localhost;dbname=mvc_demo';
        $username='root';
        $password='';
        $this->pdo=new PDO($dsn,$username,$password,array(
            PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ
        ));
    }


    function insert(array $data){
       try{
        

        $keys=implode(',',array_keys($data));
        $values=implode("','",array_values($data));
        $query="insert into users ($keys) values('$values')";
        // echo $query;
        
        return $this->pdo->prepare($query)->execute();
       

       } catch(PDOException $ex){
           return false;

       }catch(PDOStatement $ex){
        return false;
       }
        

        



    }

    function select(){

        $stmt=$this->pdo->prepare("select * from users");
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    function changeStatus($id){
        $stmt=$this->pdo->prepare("select is_active from users where id=$id");
        $stmt->execute();
        $user=$stmt->fetchObject();
        if($user->is_active==1)
        $newValue=0;
        else $newValue=1;
        $s=$this->pdo->prepare("update users set is_active =:n where id=:i");
        $s->execute([":n"=>$newValue,':i'=>$id]);


    }
}
?>