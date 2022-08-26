<?php

/*
* Database model class 
*/

class Database 
{
    /*
    * connecting to database 
    */
    protected $conn;

    protected function connect()
    {
        $string = DBDRIVER.":host=".DBHOST. ";dbname=".DBNAME;
        $this->conn = new PDO($string,DBUSER,DBPASS);
        return $this->conn;
    } 

    /*
    * query the database
    */
    public function query($query, $data=[], $data_type = "object")
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $check = $stmt->execute($data);
            if ($check) {
                if ($data_type == "object") {
                    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                }else {
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                if (is_array($data) && count($data) > 0) {
                    return $data;
                }
            }
        }
        return false;
    }
}