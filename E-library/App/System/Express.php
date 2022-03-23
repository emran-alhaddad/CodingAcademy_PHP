<?php
class Express{

    public  static $controller='home';
    public  static $method='index';
    public  static $parameters=[];

    public static function get($url,$method,$callback)
    {
      if(file_exists(System::CONTROLLER.$url.".php")){
        self::$controller=$url;  
      }
        $urlParts=explode('/',$_GET['url']);
        if(file_exists(System::CONTROLLER.$urlParts[0].".php")){
            self::$controller=$urlParts[0];  
            unset($urlParts[0]);
        }

        System::render(System::CONTROLLER.self::$controller.".php");
        $object =new self::$controller;
    
       if(isset($method)&& method_exists($object,$method)){
           self::$method=$method;
           unset($urlParts[1]);
         $this->parameters=array_values($urlParts);
       }
    
        call_user_func_array([$c,$this->method],$this->parameters);

    }

    public static function post($url,$callback)
    {
        
    }

    function __construct()
    {
       
        $urlParts=explode('/',$_GET['url']);
        //        print_r($urlParts);
       
        if(file_exists("app/controllers/".$urlParts[0].".php")){
          $this->controller=$urlParts[0];  
          unset($urlParts[0]);
        
        }

       // print_r($urlParts);

    
    }
}

?>