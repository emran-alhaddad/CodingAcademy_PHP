<?php

require_once('DataAccessLayer/DBController.php');
DBController::connectDB();


 final class TableController{


    static function getTable($table,$condition="1")
    {
        $query = "SELECT * FROM ".DBController::DB.".$table WHERE $condition";
        $result = DBController::executeQuery($query);
        return (count($result)>0 )? $result : null;
        
    }

    static function insertInto($table, $params)
    {
        $keys = "";
        $values = "";
        foreach ($params as $key => $value) {
            $keys .= $key . ' ,';
            $values .= $value . ' ,';
        }

        // delete the last , from text that cause syntax error
        $keys = substr_replace($keys ,"",-1); 
        $values = substr_replace($values ,"",-1);

        $query = "INSERT INTO ".DBController::DB.".$table ($keys) VALUES ($values)";
        return DBController::executeNonQuery($query);    
    }

    static function updateFrom($table, $params ,$condition="1")
    {
        
        $query = "UPDATE ".DBController::DB.".$table SET ";
        foreach ($params as $key => $value) {
            $value = trim($value);
            $query .= "$key = $value ,";
        }
        // delete the last , from text that cause syntax error
        $query = substr_replace($query ,"",-1); 

        $query .= " WHERE $condition";

        return DBController::executeNonQuery($query);    
    }


    static function deleteFrom($table, $condition="1")
    {
        $query = "DELETE FROM ".DBController::DB.".$table WHERE $condition";
        return DBController::executeNonQuery($query);    
    }

}


?>