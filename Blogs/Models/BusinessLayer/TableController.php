<?php

require_once('../Models/DataAccessLayer/DBController.php');

 final class TableController{

    static function getTable($table,$condition="1")
    {
        $query = "SELECT * FROM $table WHERE $condition";
        $result = DBController::executeQuery($query);
        return $result;
        
    }

    static function getTableFields($table,$fields,$condition="1")
    {
        $fields = implode(", ",$fields);
        $query = "SELECT $fields FROM $table WHERE $condition";
        $result = DBController::executeQuery($query);
        return $result;
        
    }

    static function insertInto($table, $params)
    {
        $keys = implode(", ",array_keys($params));
        $values = implode(", ",array_values($params));
        $query = "INSERT INTO $table ($keys) VALUES ($values)";
        return DBController::executeNonQuery($query);    
    }

    static function updateFrom($table, $params ,$condition="1")
    {
        
        $query = "UPDATE $table SET ";
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
        $query = "DELETE FROM $table WHERE $condition";
        return DBController::executeNonQuery($query);    
    }

}


?>