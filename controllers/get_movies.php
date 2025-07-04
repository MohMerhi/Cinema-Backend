<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../models/Model.php");
require("../models/Movies.php");

require("../connection/connection.php");

$response = [];
$response["status"] = 200;

if(!isset($_GET["id"])){
    $movies = Movie::all($mysqli);
    foreach($movies as $m){
        $response["movies"][] = $m->toArray();
    }
    echo json_encode($response);
    return;
}