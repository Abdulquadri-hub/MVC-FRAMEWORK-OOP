<?php

/*
* Model model class 
*/

class Model extends Database 
{
    public $errors = [];

    public function __construct()
    {
        switch ($this) {
            case !property_exists($this, 'table'):
                $this->table = strtolower(User::class) . "s";
                break;

            default:
                return false;
                break;
        }
    }

/*
* select first data clause 
*/
    public function first($column,$value)
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        $data =  $this->query($query,['value'=>$value,]);

        if (is_array($data)) 
        {
            $data = $data[0];
        }
        return $data;
    }

/*
* select where clause 
*/
    public function where($column,$value)
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        return $this->query($query,['value'=>$value,]);
    }

/*
* select all data clause 
*/
    public function findAll()
    {
        $query = "select * from $this->table ";
        return $this->query($query);
    }

/*
* insert data clause 
*/
    public function insert($data)
    {
/*
* remove unwanted columns  
*/
        if(property_exists($this, 'allowedColumns'))
        {
            foreach ($data as $key => $column) 
            {
                if (!in_array($key, $this->allowedColumns)) 
                {
                    unset($data[$key]);
                }
            }
        }

/*
* function before insert  
*/
        if(property_exists($this, 'beforeInsert'))
        {
            foreach ($this->beforeInsert as $function) 
            {
                $data = $this->$function($data);
            }
        }


        $keys = array_keys($data);
        $columns = implode(',', $keys);
        $values = implode(',:', $keys);
        $query = "insert into $this->table ($columns) values (:$values)";
        return $this->query($query,$data);
    }

/*
* update data clause 
*/
    public function update($id,$data)
    {
        $column = "";
        foreach ($data as $key => $value) {
            $column .= $key . " = :" . $key . ",";
        }
        $column = trim($column,",");
        $data['id'] = $id;
        $query = "update $this->table set $column where id = :id";
        echo $query;
        return $this->query($query,$data);
    }

/*
* delete data clause 
*/
    public function delete($id)
    {
        $query = "delete from $this->table where id = :id";
        $data['id'] = $id;
        return $this->query($query,$data);
    }

}