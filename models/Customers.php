<?php 


class Customers extends Model{
    private int $id;
    private string $username;
    private string $first_name;
    private string $last_name;
    private string $birth_date;
    private string $gender;
    private string $email;
    private string $phone_number;
    
    private string $password;

    protected static string $table = "customers";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->username = $data["username"];
        $this->first_name = $data["first_name"];
        $this->last_name = $data["last_name"];
        $this->birth_date = ($data["birth_date"] instanceof DateTime)? $data["birth_date"]->format("Y-m-d"): $data["birth_date"];
        $this->gender = $data["gender"];
        $this->email = $data["email"];
        $this->phone_number = $data["phone_number"];
        $this->password = $data["password"];
    }

    public function getId(){
        return $this->id; 
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function getFirstName(){
        return $this->first_name;
    }
    public function setFirstName($first_name){
        $this->first_name = $first_name;
    }
    public function getLastName(){
        return $this->last_name;
    }
    public function setLastName($last_name){
        $this->last_name = $last_name;
    }

    public function getBirthDate(){
        return $this->birth_date;
    }

    public function setBirthDate($birth_date){
        $this->birth_date = ($birth_date instanceof DateTime)? $birth_date->format("Y-m-d"): $birth_date;
    }
    public function getGender(){
        return $this->gender;
    }
    public function setGender($gender){
        $this->gender = $gender;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getPhoneNumber(){
        return $this->phone_number;
    }
    public function setPhoneNumber($phone_number){
        $this->phone_number = $phone_number;
    }
    public function getPassword(){
        return $this->password;

    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function toArray(){
        return [
            "id" => $this->id,
            "username" => $this->username,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "birth_date" =>$this->birth_date,
            "gender" => $this->gender,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "password" => $this->password
        ];
    }
}
