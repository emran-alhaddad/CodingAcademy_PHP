<?php

final class DBController
{

    
    const  DB       = "usersystem";
    const  SERVER   = "mysql:host=localhost;". self::DB .";charset=utf8mb4";
    const  USER     = "root";
    const  PASSWORD = "";

    public static $con = null;


    // connect DataBase
    static function connectDB()
    {
        try {
            self::$con = new PDO(self::SERVER,self::USER,self::PASSWORD);
            if (!self::$con) {
                die("Connection failed: " );
            }
        } catch (\Throwable $th) {
            echo "Error In Connection";
            exit();
        }

        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // check connection status
    private static function isNotConnected()
    {
        if (!is_resource(self::$con)) self::connectDB();
        return self::$con;
    }



    //  Execute Select Commands only and return result
    public static function executeQuery($query)
    {
        if (self::isNotConnected()) self::connectDB();
        $result = self::$con->prepare($query);
        $result->execute();
        if (self::isNotConnected()==false)  self::$con = null;
        return $result->fetchAll(PDO::FETCH_OBJ);
    }


    //  Execute Insert, Update and Delete Commands and return true if its executed
    public static function executeNonQuery($query)
    {
        if (self::isNotConnected()) self::connectDB();
        $result = self::$con->prepare($query);
        $result->execute();
        self::$con = null;
        if ($result) return true;
        return false;
    }
}
