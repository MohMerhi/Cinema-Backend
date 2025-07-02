<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("../models/Model.php");
require("../models/Customers.php");
require("../connection/connection.php");

$response = [];

if(!isset($_POST["id"])){
    $response["status"] = 301;
    $response["message"] = "no id was given";
}
else if(Customer::find($mysqli, $_POST["id"]) == null){
    $response["status"] = 300;
    $response["message"] = "couldn't find customer with id {$id}";

}
else{
    $customer = new Customer($_POST);
    $customer->update($mysqli,$_POST[" "])
}

