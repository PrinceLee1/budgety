<?php
  require_once 'classes/DB.php';
$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="budget.png">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/responsive-tabs/responsive-tabs.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="css/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl-carousel/owl.theme.default.min.css">
    <title>Update your Profile</title>
</head>
<body>
    
</body>
</html>