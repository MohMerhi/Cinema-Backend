<?php

use Vtiful\Kernel\Format;

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
        $valuesInQuery = static::sqlValueForm($values);
        $sql = sprintf("Update %s set %s where %s = ?", 
            static::$table,
            $valuesInQuery,
            $id);
        $query = $mysqli->prepare($sql);
        static::bindToQuery($mysqli,$query,$values);
        $query->bind_param('i',$id);
        $query->execute();
        //$data = $query->get_result()->fetch_assoc();

    }

    public function delete(mysqli $mysqli, int $id){
        $sql = sprintf("Delete From %s where %s = ?", static::$table, static::$primary_key );
        $query = $mysqli->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

    }

    public static function create(mysqli $mysqli, $values){
        
        $columnNames = "";
        $columnValues = "";
        static::creationColumnForm($values, $columnNames, $columnValues);
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", static::$table, $columnNames, $columnValues);
        $query = $mysqli->prepare($sql);
        static::bindToQuery($mysqli, $query, $values);
        $query->execute();
        
    }

    public static function sqlValueForm(&$values){
        $normalArray = [];
        foreach($values as $key => $value){
            $normalArray[] = $key + " = ?";
        }
        return implode(",",$normalArray);
    }

    public static function creationColumnForm(&$values, &$columnNames, &$columnValues){
        $columnArrayNames = [];
        $columnArrayValues = [];
        foreach($values as $key => $value){
            $columnArrayNames[] = $key;
            $columnArrayValues[] = "?";
        }
        $columnNames = implode(",", $columnArrayNames);
        $columnValues = implode(",", $columnArrayValues);

    }

    public static function bindToQuery($mysqli,&$query,&$values){
        foreach($values as $key => $value){
            if(is_int($value)){
                $s = 'i';

            }
            else if(is_float($value)){
                $s = 'f';
            }
            else{
                $s = 's';
            }
            $query->bind_param($s,$value);
        } 
    }
}