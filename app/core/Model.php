<?php

defined('ROOTPATH') OR exit('Access Denied!');

/*
* TRAIT MODEL 
*/


Trait  Model {

    use Database;

    public $errors = [];

    public function __construct()
    {
        if(!property_exists($this, 'table'))
        {
            $this->table = strtolower($this::class) . "s";
        }
    }

    /** PRIMARY KEY */
    public function get_primary_key(mixed $table): string
    {
        $query = "SHOW KEYS FROM $table WHERE key_name = 'PRIMARY'";
        $data = $this->query($query);
        if(!empty($data[0]))
        {
            return $data[0]->Column_name;
        }

        return 'id';
    }


    /** FIRST */
    public function first(mixed $column, mixed $value,mixed $orderby = 'desc',)
    {
        $primary_key = $this->get_primary_key($this->table);
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value order by $primary_key $orderby";
        $data =  $this->query($query,['value'=>$value,]);

        if (is_array($data)) 
        {
            $data = $data[0];
        }
        return $data;
    }



    /** WHERE */
    public function where(mixed $column, mixed $value,mixed $orderby = 'desc', mixed $limit = 10, mixed $offset = 0)
    {
        $primary_key = $this->get_primary_key($this->table);
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value order by $primary_key $orderby limit $limit offset $offset";
        return $this->query($query,['value'=>$value,]);
    }


    /** FIND ALL */
    public function findAll(mixed $orderby = 'desc', mixed $limit = 100, mixed $offset = 0)
    {
        $primary_key = $this->get_primary_key($this->table);
        $query = "select * from $this->table order by $primary_key $orderby limit $limit offset $offset";
        return $this->query($query);
    }


    /* INSERT */ 
    public function insert($data)
    {
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

    /** UPDATE */
    public function update($id,$data)
    {
        $column = "";
        foreach ($data as $key => $value) {
            $column .= $key . " = :" . $key . ",";
        }
        $column = trim($column,",");
        $data['id'] = $id;
        $query = "update $this->table set $column where id = :id";
        return $this->query($query,$data);
    }


    /** DELETE */
    public function delete($id)
    {
        $query = "delete from $this->table where id = :id";
        $data['id'] = $id;
        return $this->query($query,$data);
    }

}