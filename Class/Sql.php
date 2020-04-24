<?php

class Sql extends PDO
{

    private $conm;

    public function __construct()
    {

        $this->conm = new PDO("sqlsrv:Database=dbphp7;server=localhost\SQLEXPRESS;ConnectionPooling=0","sa","root");

    }    
    
    private function setParams($statement, $paramenters = array())
    {

        foreach($paramenters as $key => $values)
        {

            $this->setParam($statement,$key,$values);

        }

    }

    private function setParam($statement,$key,$values)
    {

        $statement->bindParam($key,$values);
    }
    
    public function query($rawQuery, $params=array())
    {

        $stmt = $this->conm->prepare($rawQuery);

        $this->setParams($stmt,$params);

        $stmt->execute();
        
        return $stmt;

    }

    public function select($rawQuery, $params = array()):array
    {

        $stmt = $this->query($rawQuery,$params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
