<?php

final class DBController
{

    const  SERVER   = "localhost";
    const  DB       = "blogs";
    const  USER     = "root";
    const  PASSWORD = "";

    public static $con = null;


    // connect DataBase
    static function connectDB()
    {
        try {
            self::$con = new mysqli(self::SERVER, self::USER, self::PASSWORD, self::DB);
            if (!self::$con->ping()) {
                die("Connection failed: " . self::$con->connect_error);
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
        return self::$con->connect_error;
    }



    //  Execute Select Commands only and return result
    public static function executeQuery($query)
    {
        if (self::isNotConnected()) self::connectDB();
        $result = self::$con->query($query);
        if (self::isNotConnected()==false) self::$con->close();
        return $result;
    }


    //  Execute Insert, Update and Delete Commands and return true if its executed
    public static function executeNonQuery($query)
    {
        if (self::isNotConnected()) self::connectDB();
        $result = self::$con->query($query);
        self::$con->close();
        if ($result) return true;
        return false;
    }
}
