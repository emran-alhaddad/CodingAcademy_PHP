<?php
interface Controller{
    function show();
    function add();
    function update();
    function delete();
    function empty();
    function __set($name, $value);
    function __get($name);
}
?>