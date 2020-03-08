<?php
require_once 'classes/DB.php';
 
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        echo 'I have been run';
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'username' => array(
            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password' => array(
            'required' => true,
            'min' => 6
        ),
        'password_again' => array(
            'required' => true,
            'matches' => 'password'
        ),
        'name' => array(
            'required' => true,
            'min' => 2,
            'max' => 50
        ),

    ));
    if($validation->passed()){
        Session::flash('success','You registered Successfully');
        header('Location: index.php');
    }else{
    foreach($validation->errors() as $error){
        echo $error, '<br>';
    }
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="favicon" href="budget.png">
    <title>Get Started | Earn, Spend and Keep Track</title>
</head>
<body>
    <form action="" method="post">
    <div class="field">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" autocomplete="off" value="<?php echo escape(Input::get('username')) ?>">
    </div>

    <div class="field">
    <label for="password">Choose a Password</label>
    <input type="password" name="password" id="password" autocomplete="off" value="<?php echo escape(Input::get('password')) ?>">
    </div>

    <div class="field">
    <label for="password_again">Repeat Password</label>
    <input type="password" name="password_again" id="password_again" value="<?php echo escape(Input::get('password_again')) ?>">
    </div>
    <div class="field">
    <label for="name">Your Name</label>
    <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')) ?>">
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <input type="submit" value="Register">
    </form>
</body>
</html>