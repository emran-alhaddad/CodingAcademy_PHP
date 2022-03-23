<?php

class Router{

    public function __construct()
    {
        
    }

    public function use($url,$calback)
    {
        $calback($url);
    }
}

?>