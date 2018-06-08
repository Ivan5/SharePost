<?php

class User {
  private $db;

  public function __construct(){
    $this->db = new Database;
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
}