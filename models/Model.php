<?php

abstract class Model{
    protected static string $table;

    protected static string $primary_key;

    public static function find(mysqli $mysqli, int $id){
        $sql = sprintf("Select * from %s Where %s = ?", static::$table, static::$primary_key);
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();
        $data = $query->get_result()->fetch_assoc();
        return $data? new static($data) : null;
    }

    public static function all(mysqli $mysqli){
        $sql = sprintf("Select * from %s",static::$table);
        $query= $mysqli->prepare($sql);
        $query->execute();
        $data = $query->get_result();
        $objects = [];
        while($row = $data->fetch_assoc()){
            $objects[] = new static($row);
        }
        return $objects;
    }

    public function update(mysqli $mysqli, array $values, int $id){
        $updateValues = static::associativeToString($values);
        $sql = sprintf("Update %s set ? where %s = ?", 
            static::$table,
            $updateValues,
            $id);
        $query 


    }

    public static function associativeToString($data){
        $normalArray = [];
        foreach($data as $key => $value){
            $normalArray[] = $key + " = " + $value;
        }
        return $normalArray.implode(",");
    }
}