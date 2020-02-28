<?php
session_start();
$GLOBALS['config']= array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'newuser',
        'password' => 'password',
        'db' => 'budgety'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user'
    )
);
spl_autoload_register(function($class){
require_once 'classes/ '. $class .'.php';
});//This method allows you to pass in a function that is run everytime a class is accessed
require_once 'functions/sanitize.php';
?>