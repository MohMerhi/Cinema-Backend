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
        $data = $query->get_result()->fetch_assoc();

    }



    public static function sqlValueForm(&$values){
        $normalArray = [];
        foreach($values as $key => $value){
            $normalArray[] = $key + " = ?";
        }
        return $normalArray.implode(",");
    }

    public static function getDatatype($param){
        
    }

    public static function bindToQuery($mysqli,&$query,&$values){
        foreach($values as $key => $value){
            if($value instanceof DateTime){
                $s = 's';
                $date = $value->format('Y-m-d');
                $time = $value->format('H:i:s');
                if($date == '1970-1-1'){
                    $value = $date;
                }
                else{
                    $value = $time;
                }
            }
            else if(is_int($value)){
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