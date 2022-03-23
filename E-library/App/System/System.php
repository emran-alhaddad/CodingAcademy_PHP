<?php

class System{

    public const ROOT = "App/";
    public const SYSTEM = self::ROOT."System/";
    public const MODEL = self::ROOT."Model/";
    public const VIEW = self::ROOT."View/";
    public const CONTROLLER = self::ROOT."Controller/";
    public const COMPONENTS = self::VIEW."Components/";



    public static function render($file,...$args)
    {
        if(file_exists(self::VIEW.$file.".php"))
        require_once(self::VIEW.$file.".php");
        else
        throw new Error(code:Error::FILE_NOT_FOUND);
    }

    public static function redirect($dest)
    {
        try {
            return header("Location:".self::VIEW.$dest);
        } catch (Error $err) {
            throw new Error(code:Error::DIR_NOT_FOUND);
        }
        
    }
}
