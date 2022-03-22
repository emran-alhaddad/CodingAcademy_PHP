<?php

final class DBController
{

    const  SERVER   = "localhost";
    const  DB       = "blog";
    const  USER     = "root";
    const  PASSWORD = "";
    const  DSN = "mysql:host=" . self::SERVER . ";dbname=" . self::DB . ";";

    public static $PDO = null;


    // connect DataBase
    static function connectDB()
    {
        try {
            if (!self::isConnected()) {
                self::$PDO = new PDO(self::DSN, self::USER, self::PASSWORD);
                self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                return self::getPDO();
            }
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }

    // check connection status
    public static function getPDO()
    {
        return self::$PDO;
    }

    private static function isConnected()
    {
        return self::$PDO != null;
    }



    //  Execute Select Commands only and return result
    public static function executeQuery($query)
    {
        if (!self::isConnected()) self::connectDB();
        $result = self::$PDO->query($query);
        if (self::isConnected()) self::$PDO = null;
        return $result->fetchAll();
    }


    //  Execute Insert, Update and Delete Commands and return true if its executed
    public static function executeNonQuery($query)
    {
        if (self::isNotConnected()) self::connectDB();
        $result = self::$PDO->query($query);
        if (self::isConnected()) self::$PDO = null;
        if ($result->num_rows>0) return true;
        return false;
    }
}
