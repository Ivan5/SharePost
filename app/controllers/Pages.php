<?php

class Pages extends Controller{
  public function __construct(){
    //echo 'Pages Loaded';
    
  }

  public function index(){
   
    $data = [
      'title' => 'SharePosts',
      'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum expedita perferendis aliquam earum culpa eos consequuntur facere eaque cum cumque temporibus dolorem, doloribus sint assumenda repellendus? Distinctio molestiae earum neque?'
    ];
    
    $this->view('pages/index',$data);
  }

  public function about(){
    $data = [
      'title' => 'About Us',
      'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum expedita perferendis aliquam earum culpa eos consequuntur facere eaque cum cumque temporibus dolorem, doloribus sint assumenda repellendus? Distinctio molestiae earum neque?'      
    ];
    $this->view('pages/about',$data);
  }
}