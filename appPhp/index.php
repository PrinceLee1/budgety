<?php
  require_once 'classes/DB.php';

  $user = DB::getInstance()->get('users', array('username', '=', 'ken'));
  if(!$user->count()){
    echo 'No user';
  }else{
  echo $user->first()->password;

  }
