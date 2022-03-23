<?php
require_once("Express.php");
require_once("Router.php");

class Server{

    public $express;
    public $router;

    public function __construct()
    {
        $this->express = new Express();
        $this->router = new Router();

        $url=explode('/',$_GET['url']);

        $this->router->use($url,function($d){
            print_r($d);
        });
    }

}

?>