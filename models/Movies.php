<?php

class Movies extends Model{
    private int $id;
    private string $title;
    private string $description;
    private string $release_date;
    private string $poster;
    private string $trailer;

    private string $studio;

    private string $movie_length;

    protected static string $table = "movies";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->description = $data["description"];
        $this->poster = $data["poster"];
        $this->trailer = $data["trailer"];
        $this->studio = $data["studio"];
        $this->release_date = ($data["release_date"] instanceof DateTime)? $data["release_date"]->format("Y-m-d"): $data["release_date"];
        $this->movie_length = ($data["movie_length"] instanceof DateTime)? $data["movie_length"]->format("H:i:s"): $data["movie_length"];
        
    }

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getPoster(){
        return $this->poster;
    }
    public function getTrailer(){
        return $this->trailer;
    }
    public function getStudio(){
        return $this->studio;
    }
    public function getReleaseDate(){
        return $this->release_date;
    }
    public function getMovieLength(){
        return $this->movie_length;
    }

    public function setTitle($title){
        $this->title = $title;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setReleaseDate($releaseDate){
        $this->release_date = ($releaseDate instanceof DateTime)? $releaseDate->format("Y-m-d"): $releaseDate;
    }
    public function setPoster($poster){
        $this->poster = $poster;
    }
    public function setTrailer($trailer){
        $this->trailer = $trailer;
    }

    public function setStudio($studio){
        $this->studio = $studio;
    }
    public function setMovieLength($movie_length){
        $this->movie_length = ($movie_length instanceof DateTime)? $movie_length->format("H:i:s"): $movie_length;
    }

    public function toArray(){
        return [$this->id, $this->title, $this->release_date];
    }
}