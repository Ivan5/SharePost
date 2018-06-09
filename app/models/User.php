<?php

class User {
  private $db;

  public function __construct(){
    $this->db = new Database;
  }

  //Register user
  public function register($data){
    $this->db->query('insert into users (name,email,password) values (:name,:email,:password)');
    //Bind values
    $this->db->bind(':name',$data['name']);
    $this->db->bind(':email',$data['email']);
    $this->db->bind(':password',$data['password']);

    //Execute statemt
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }

  //Find user by email
  public function findUserByEmail($email){
    //Do query to find a register with the email
    $this->db->query('select * from users where email = :email');
    //Bind the prepare stament
    $this->db->bind(':email',$email);
    //set the single query
    $row = $this->db->single();
    //Check row count
    if($this->db->rowCount($row)){
      return true;
    }else{
      return false;
    }
  }

  public function getUserById($id){
    //Do query to find a register with the email
    $this->db->query('select * from users where id = :id');
    //Bind the prepare stament
    $this->db->bind(':id',$id);
    //set the single query
    $row = $this->db->single();
    //Check row count
    return $row;
  }

  public function login($email,$password){
    $this->db->query('select * from users where email = :email');
    $this->db->bind(':email',$email);

    $row = $this->db->single();
    $hashed_password = $row->password;
    if(password_verify($password,$hashed_password)){
      return $row;
    }else{
      return false;
    }
  }
}