<?php
class Post {
  private $db;

  public function __construct(){
    $this->db = new Database;
  }

  public function getPosts(){
    $this->db->query('select *, posts.id as postId, users.id as userId, posts.created_at as postCreated,users.created_at as userCreated from posts inner join users on posts.user_id = users.id order by posts.created_at desc');
    $results = $this->db->resultSet();

    return $results;
  }

  public function addPost($data){
    $this->db->query('insert into posts (title,user_id,body) values (:title,:user_id,:body)');
    //Bind values
    $this->db->bind(':title',$data['title']);
    $this->db->bind(':user_id',$data['user_id']);
    $this->db->bind(':body',$data['body']);

    //Execute statemt
    if($this->db->execute()){
      return true;
    }else{
      return false;
    }
  }
}