<?php
/**
 * App Core Class
 * creates URL & Loads core controller
 * URL Format - /controller/method/params
 */
class Core 
{
    protected $currentController = 'Pages'; //Default value of controller rennder views
    protected $currentMethod = 'index'; //Default index method
    protected $params = []; //Params can get of the URL

    public function __construct(){
      //print_r($this->getUrl());
      $url = $this->getUrl(); //Asigned the values of the url
      //Look in controllers for first value
      if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){ //Check if exists any file with the name of url get
        //If exists, set as controller
        $this->currentController = ucwords($url[0]); //Asigned the controller at current controller var
        //Unset 0 index
        unset($url[0]);
      }
      //require the controller
      require_once '../app/controllers/'.$this->currentController.'.php';
      //Instantiate controller class
      $this->currentController = new $this->currentController;

      //Check for second part of the url
      if(isset($url[1])){
        //Check to see if method exist in controller
        if(method_exists($this->currentController,$url[1])){
          $this->currentMethod = $url[1]; //Asigned the value of url about method at the currentMethod var
          //unset 1 index
          unset($url[1]);
        }
      }

      //GEt params
      $this->params = $url ? array_values($url) : [];

      //Call back with array of params
      call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
    }
    //Get the values of the url
    public function getUrl(){
      if(isset($_GET['url'])){ //verify is exists some paramas
        $url = rtrim($_GET['url'], '/'); //trim params about /
        $url = filter_var($url, FILTER_SANITIZE_URL); //Sanitize the url without other caractesr
        $url = explode('/', $url); // Split string by string of the url
        return $url; //Return that url
      }
    }
}
