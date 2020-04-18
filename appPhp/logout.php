<?php
require_once 'classes/DB.php';

$user = new User();
$logout = $user->logout();

Redirect::to('../index.html');