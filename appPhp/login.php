<?php
require_once 'classes/DB.php';
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST,array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));
        if($validation->passed()){
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if($login){
                Redirect::to('index.php');
            }else{
                echo '<p>Sorry logging in failed</p>';
            }
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
    <link rel="shortcut icon" href="../budget.png">
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="../css/responsive.css">
<link rel="stylesheet" href="../css/responsive-tabs/responsive-tabs.min.css">
    <title>Login to Your Account | Earn, Spend and Keep Track</title>

    <style>
        *{
            font-family: "Nunito Sans", sans-serif;
        }
        .register-page{
           
            margin-top:100px;
        }
        h3{
            text-align:center;
        }
        p{color:gray;margin-top:24px}
        .form-control{
            margin-top:20px;
            height:40px;
          border-top:1px solid #28B9B5;
          border-bottom:0px;
          border-right:0px; border-left:0px
        }
        input[type="checkbox"]{
            margin-top:18px;
        }
        a{
            color:#f41366;float:right;transform:translateY(-20px);
            margin-right:60px;font-size:15px;text-decoration:none

        }
        .submit{
            margin-bottom:18px;
            width:150px;
            height:45px;
            margin-left:100px;
            background-color:#28B9B5;
            color:white;
            border:0px;
            cursor:pointer;
            border-radius:18px
        }
        .submit:hover{
            background-color:#f41366
        }
        .user-img{
          height:637px;
          width:850px;
transform:translateX(-46px);
            opacity:6
        }
        .user{
            margin-top:10px;
            margin-left:100px;
            border:12px solid grey;
            border-radius:65px
        }
    }
/*** MEDIA QUERIES***/
@media (min-width: 768px) and (max-width: 991px) {
    .user-img{
                 display:none
             }
             h3{
                 transform:translateY(40px);
                 font-size:30px
             }
        .takes{margin-top:70px;font-size:20px}
        .submit{
            width:70%;
            margin-top:20px
        }
                .container-fluid{
           background-image:  url(../login.jpeg);
    background-position: center;
       }
       .register-page{
           background-color:white;
    border-radius: 5px;
    height: 480px;
    margin-bottom:20px
       }
       .already{
           margin-left:40px;
           font-size:18px
       }
}

        @media (max-width:480px){

            .user-img{
                 display:none
             }
             h3{
                 transform:translateY(40px)
             }
        .takes{margin-top:70px}
        .submit{
            width:150px;
            transform:translateY(-33px);

        }
                .container-fluid{
           background-image:  url(../register.jpeg);
    background-position: center;
       }
       .register-page{
           background-color:white;
    border-radius: 5px;
    height: 350px;
    margin-bottom:20px
       }
    
       }
        

            @media (max-width: 320px) {
             .user-img{
                 display:none
             }
             h3{
                 transform:translateY(40px)
             }
        .takes{margin-top:70px}
        .submit{
            width:120px;
            transform:translateY(-33px);
            
        }
                .container-fluid{
           background-image:  url(../register.jpeg);
    background-position: center;
       }
       .register-page{
           background-color:white;
    border-radius: 5px;
    height: 350px;
    margin-bottom:16px
       }
       .already{
           margin-left:10px
       }
            }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
            <img src="../register.jpeg" alt="signup" class="user-img">
    </div>
    <div class="col-md-4">
    <form action="" method="post">
        <div class="register-page">
        <h3>LOG IN</h3>
        <p class="text-center takes">Log In to Start Keeping Track.</p>
    <div class="col-md-12">
        <div class="field">
            <input type="text" name="username" id="username" autocomplete="off" required class="form-control" placeholder="USERNAME">
        </div>
        </div>
        <div class="col-md-12">
        <div class="field">
            <input type="password" name="password" id="password" autocomplete="off" required class="form-control" placeholde="PASSWORD">
        </div>
        </div>
        <div class="col-md-12">
            <div class="field">
                <input type="checkbox" name="remember" id="remeber">   Remember Me.
            </div>
</div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"><br>
            <button type="submit" class="btn btn-primary submit form-control">LOG IN</button>
            <a href="register.php" class="text-center already">Back to Signup.</a>

</div>
</form>
</div>
</div>
</div>
</body>
</html>