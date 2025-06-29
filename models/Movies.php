<?php

class Movies extends Model{
    private int $id;
    private string $title;
    private string $description;
    private DateTime $release_date;
    private string $poster;
    private string $trailer;

    private string $studio;

    private DateTime $movie_length;

    protected static string $table = "movies";
}