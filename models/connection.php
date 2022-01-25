<?php

class Connection{
  static public function connect(){
    $dsn = "mysql:host=localhost;dbname=pos";
    $user = "root";
    $password = "";

    try{
      $link = new PDO($dsn, $user, $password);
      $link -> exec("set names utf8");
      return $link;
    }
    catch(¥Exception $e){
      echo $e->getMessage();
    }
    // finally {
    //   echo 'finally';
    // }
    
  }
}