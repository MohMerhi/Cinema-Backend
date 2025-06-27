<?php
require("../connection/connection.php");

$queries = [
        "CREATE TABLE customers(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        birth_date DATE NOT NULL,
        gender CHAR(1) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone_number VARCHAR(30) NULL,
        password VARCHAR(255) NOT NULL) ",
        
        "CREATE TABLE movies(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        release_date DATE NOT NULL,
        poster VARCHAR(255) NOT NULL,
        trailer VARCHAR(255) NOT NULL,
        studio VARCHAR(255) NOT NULL,
        movie_length TIME NOT NULL)",

        "CREATE TABLE actors(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        birth_date DATE NOT NULL,
        gender CHAR(1) NOT NULL,
        picture VARCHAR(255) NOT NULL)",

        "CREATE TABLE Genres(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL)",

        "CREATE TABLE movie_cast(
        movie_id INT(11) NOT NULL,
        actor_id INT(11) NOT NULL,
        FOREIGN KEY (movie_id) REFERENCES movies(id),
        FOREIGN KEY (actor_id) REFERENCES actors(id),
        PRIMARY KEY (movie_id, actor_id))",

        "CREATE TABLE movie_genres(
        movie_id INT(11) NOT NULL,
        genre_id INT(11) NOT NULL,
        FOREIGN KEY (movie_id) REFERENCES movies(id),  
        FOREIGN KEY (genre_id) REFERENCES genres(id),  
        PRIMARY KEY (movie_id, genre_id))",

        "CREATE TABLE movie_schedules(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        movie_id INT(11),
        airing_day DATE NOT NULL,
        airing_time TIME NOT NULL,
        ticket_price DECIMAL(6,2) NOT NULL,
        quality VARCHAR(30) NOT NULL,
        FOREIGN KEY (movie_id) REFERENCES movies(id))",
        
        "CREATE TABLE tickets (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        customer_id INT(11),
        movie_schedule_id INT(11),
        row_seat CHAR(1),
        col_seat CHAR(1),
        FOREIGN KEY (movie_schedule_id) REFERENCES movie_schedules(id),
        FOREIGN KEY (customer_id) REFERENCES customers(id))"
        
];

foreach($queries as $query){
    $execute = $mysqli->prepare($query);
    $execute->execute();
}
