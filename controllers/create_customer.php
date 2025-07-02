<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("../models/Model.php");
require("../models/Customers.php");
require("../connection/connection.php");


$response = [];


if(!isset($_POST["username"]) || Customer::findByValues($mysqli,["username" => $_POST["username"]])){
    $response["status"] = 302;
    $response["message"] = "username already taken or invalid";
}

else if(!isset($_POST["email"]) || Customer::findByValues($mysqli,["email" => $_POST["email"]])){
    $response["status"] = 302;
    $response["message"] = "email already taken or invalid";

}

else if(!isset($_POST["phone_number"]) || Customer::findByValues($mysqli,["phone_number" => $_POST["phone_number"]])){
    $response["status"] = 302;
    $response["message"] = "phone_number already taken or invalid";

}

else {
    Customer::create($mysqli,[
            "username" => $_POST["username"],
            "first_name" => $_POST["first_name"],
            "last_name" => $_POST["last_name"],
            "birth_date" =>$_POST["birth_date"],
            "gender" => $_POST["gender"],
            "email" => $_POST["email"],
            "phone_number" => $_POST["phone_number"],
            "password" => $_POST["password"]]);

            $response["status"] = 204;
    }

echo json_encode($response);


