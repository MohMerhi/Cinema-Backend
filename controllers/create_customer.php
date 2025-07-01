<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require("../models/Model.php");
require("../models/Customers.php");
require("../connection/connection.php");


$response = [];


if(!isset($_POST["username"]) || Customers::findByValues($mysqli,["username" => $_POST["username"]])){
    $response["status"] = 302;
    $response["message"] = "username already taken";
}

else if(!isset($_POST["email"]) || Customers::findByValues($mysqli,["email" => $_POST["email"]])){
    $response["status"] = 302;
    $response["message"] = "email already taken";

}

else if(!isset($_POST["phone_number"]) || Customers::findByValues($mysqli,["phone_number" => $_POST["phone_number"]])){
    $response["status"] = 302;
    $response["message"] = "phone_number already taken";

}

else {
    Customers::create($mysqli,[
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


