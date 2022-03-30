<?php

use function PHPSTORM_META\type;

abstract class ORDERBY
{
    public const ASC = "ASC";
    public const DESC = "DESC";
}


abstract class QueryType
{
    public  const SELECT = "SELECT Query";
    public  const INSERT = "INSERT Query";
    public  const UPDATE = "UPDATE Query";
    public  const DELETE = "DELETE Query";
    public  const DONE = 1005;
}


class Query
{

    protected $fields;
    protected $tables;
    protected $where;
    protected $logic;
    protected $values;



    public function __construct()
    {
        $this->fields = [];
        $this->tables = [];
        $this->where = [];
        $this->logic = "AND";
        $this->values = [];
    }

    public function setLogic($type)
    {
        if (strtoupper($type) === "AND" || strtoupper($type) === "OR")
            $this->logic = strtoupper(" " . $type . " ");
        return $this;
    }


    public function __set($name, $value)
    {
        if (in_array($name, ["fields", "tables", "values", "where"])) {
            if (is_string($value))
                array_push($this->$name, $value);
            else
                array_merge($this->$name, $value);
        }
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
