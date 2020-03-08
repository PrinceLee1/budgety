<?php
  require_once 'classes/DB.php';

if(Session::exists('success')){
  echo Session::flash('success');
}
 
