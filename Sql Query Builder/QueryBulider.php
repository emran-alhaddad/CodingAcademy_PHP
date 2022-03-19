<?php

require_once('SelectQuery.php');
require_once('DBConnection.php');



class QueryBuilder
{


    private $pdo;
    private $selectQuery;
    private $finalQuery;
    public $styledQuery;

    public function __construct()
    {
        $this->pdo = DBConnection::connect();
        $this->selectQuery = new SelectQuery();
        $this->finalQuery = "";
        $this->styledQuery = "";
    }


    // SELECT [*|fields] 
    public function select($fields = "*"): self
    {
        return $this->fillArgs("fields", $fields, func_get_args());
    }

    // Count() 
    public function count($fields = "*"): self
    {
        return $this->fillArgs("count", $fields, func_get_args());
    }

    // Sort 
    public function sort($sortType = ORDERBY::ASC): self
    {
        $this->selectQuery->setSortType($sortType);
        return $this;
    }

    // SELECT [all|distict] 
    public function distinct(): self
    {
        $this->selectQuery->settype("distinct");
        return $this;
    }

    // Logic between conditions 
    public function or(): self
    {
        $this->selectQuery->setLogic("OR");
        return $this;
    }

    // Logic between conditions 
    public function and(): self
    {
        $this->selectQuery->setLogic('AND');
        return $this;
    }

    // FROM table1[,table2,..]
    public function from($table): self
    {
        return $this->fillArgs("tables", $table, func_get_args());
    }

    // WHERE conditions
    public function where($condition = "1"): self
    {
        return $this->fillArgs("where", $condition, func_get_args());
    }


    // GROUPBY conditions
    public function groupBy($field): self
    {
        return $this->fillArgs("groupBy", $field, func_get_args());
    }

    // HAVING conditions
    public function having($condition): self
    {
        return $this->fillArgs("having", $condition, func_get_args());
    }

    // ORDERBY conditions
    public function orderBy($field): self
    {
        return $this->fillArgs("orderBy", $field, func_get_args());
    }

    public function innerJoin($table, $on)
    {
        $this->selectQuery->setJoin("Inner", $table, $on);
        return $this;
    }

    public function leftJoin($table, $on)
    {
        $this->selectQuery->setJoin("Left", $table, $on);
        return $this;
    }

    public function rightJoin($table, $on)
    {
        $this->selectQuery->setJoin("Right", $table, $on);
        return $this;
    }

    public function buildQuery()
    {
        // get Count
        $count = implode(", ", $this->selectQuery->count);

        // get Fields
        $fields = implode(", ", $this->selectQuery->fields);

        // get tables
        $tables = implode(", ", $this->selectQuery->tables);

        // get InnerJoin
        $innerJoin  = "";
        foreach($this->selectQuery->innerJoin as $row)
        foreach ($row as $table => $cols) {
            $innerJoin .= " INNER JOIN ".$table." ON ".$cols." ";
        }

        // get LeftJoin
        $leftJoin  = "";
        foreach($this->selectQuery->leftJoin as $row)
        foreach ($row as $table => $cols) {
            $leftJoin .= " LEFT JOIN ".$table." ON ".$cols." ";
        }

        // get RightJoin
        $rigthJoin  = "";
        foreach($this->selectQuery->rightJoin as $row)
        foreach ($row as $table => $cols) {
            $rigthJoin .= " RIGHT JOIN ".$table." ON ".$cols." ";
        }

        // get  Where Conditions
        $wheres = implode(" ", $this->selectQuery->where);

        // get Group By Conditions
        $groups = implode(', ', $this->selectQuery->groupBy);

        // get Having Conditions
        $havings = implode($this->selectQuery->logic, $this->selectQuery->having);

        // get Order By Conditions
        $orders = implode(', ', $this->selectQuery->orderBy);

        if (!empty($count)) $count = " COUNT(" . $count . ")";
        if (!empty($wheres)) $wheres = " WHERE " . $wheres;
        if (!empty($groups)) $groups = " GROUP BY " . $groups;
        if (!empty($havings)) $havings = " HAVING " .  $havings;
        if (!empty($orders)) $orders = " ORDER BY " .  $orders;

        if (!empty($fields) && !empty($count)) $count .= " , ";

        $this->finalQuery = "SELECT " .
            $this->selectQuery->type . " " . $count . " " .
            $fields . " FROM " . $tables . $innerJoin . $leftJoin . $rigthJoin 
            . $wheres .  $groups .
            $havings .  $orders;
        
        

            $this->styledQuery = "SELECT" .$this->selectQuery->type.$count.
            $fields . "FROM " . $tables . $innerJoin . $leftJoin . $rigthJoin 
            . $wheres .  $groups .
            $havings .  $orders;

            $newLine = "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $this->styledQuery = str_replace("SELECT","<i>SELECT</i> ",$this->styledQuery);
            $this->styledQuery = str_replace("DISTINCT"," <i>DISTINCT</i>$newLine",$this->styledQuery);
            $this->styledQuery = str_replace("COUNT"," <i>COUNT</i>",$this->styledQuery);
            $this->styledQuery = str_replace("FROM","<br><i>FROM</i>$newLine",$this->styledQuery);
            $this->styledQuery = str_replace("WHERE","<br><i>WHERE</i>$newLine",$this->styledQuery);
            $this->styledQuery = str_replace("GROUP BY","<br><i>GROUP BY</i> ",$this->styledQuery);
            $this->styledQuery = str_replace("HAVING","<br><i>HAVING</i> ",$this->styledQuery);
            $this->styledQuery = str_replace("ORDER BY","<br><i>ORDER BY</i>$newLine",$this->styledQuery);
            $this->styledQuery = str_replace(", ",", $newLine",$this->styledQuery);
            $this->styledQuery = str_replace("INNER JOIN","<br><i>INNER JOIN</i> ",$this->styledQuery);
            $this->styledQuery = str_replace("LEFT JOIN","<br><i>LEFT JOIN</i> ",$this->styledQuery);
            $this->styledQuery = str_replace("RIGHT JOIN","<br><i>RIGHT JOIN</i> ",$this->styledQuery);
            $this->styledQuery = str_replace("ON"," <i>ON</i> ",$this->styledQuery);
            $this->styledQuery = str_replace("ASC"," <i>ASC</i> ",$this->styledQuery);
            $this->styledQuery = str_replace("DESC"," <i>DESC</i> ",$this->styledQuery);
            


    }

    public function getFinalQuery()
    {
        return $this->finalQuery;
    }

    public function execute()
    {
        try {
            $this->buildQuery();
            $stmt = $this->pdo->prepare($this->finalQuery);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $error) {
            echo "<p style='color:red'>$error;</p>";
            // exit();
        }
    }





    // -----------------------------------

    // Fill Arguments Template
    private function fillArgs($property, $default, $args)
    {
        $logic = (strtoupper($property) === "WHERE" || strtoupper($property) === "HAVING") ?
            $this->selectQuery->logic : "";

        $sortType = (strtoupper($property) === "ORDERBY") ?
            " " . $this->selectQuery->sortType : "";

        if (count($args) > 1)
            foreach ($args as $arg) {
                $this->selectQuery->$property =  $logic . $arg . $sortType;
            }
        else {
            if (count($this->selectQuery->$property) >= 1)
                $this->selectQuery->$property = $logic . $default . $sortType;
            else
                $this->selectQuery->$property = $default . $sortType;
        }


        return $this;
    }
}
