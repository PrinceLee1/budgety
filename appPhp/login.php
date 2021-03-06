<?php
require_once 'classes/DB.php';
if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST,array(
            'username' => array('required' => true),
            'password' => array('required' => true,
        ),
        ));
        if($validation->passed()){
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if($login){
                Redirect::to('index.php');
            }else{
                echo '<p class="text-center pError">Username or Password is not Correct!</p>';
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
<link rel="stylesheet" href="../css/animate/animate.min.css">

<link rel="stylesheet" href="../css/responsive-tabs/responsive-tabs.min.css">
    <title>Login to Your Account | Earn, Spend and Keep Track</title>

    <style>
        *{
            font-family: "Nunito Sans", sans-serif;
        }
        .register-page{
           
            margin-top:100px;
        }
        .pError{
            background:red;
            font-size:23px;
            color:white;
            height:50px
            
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
        .form-control:focus{
            border:1px solid #28B9B5;

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
            width:100%;
            height:45px;
            /* margin-left:100px; */
            background-color:#28B9B5;
            color:white;
            border:0px;
            cursor:pointer;
            border-radius:18px
        }
        .submit:hover{
            background-color:#f41366
        }
        aside{
            height: 100vh;
    background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.9)), url("https://dev.tinkerfcu.org/wp-content/uploads/Young-woman-creating-a-budget.jpg");
    background-size: cover;
    background-position: center;
    position: relative;
    transform:translateX(-40px);


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
    aside{
                 display:none
             }
             h3{
                 transform:translateY(40px);
                 font-size:30px
             }
        .takes{margin-top:70px;font-size:20px}
        .submit{
            /* width:70%; */
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
           /* margin-left:40px; */
           font-size:18px
       }
}

        @media (max-width:480px){

            aside{
                 display:none
             }
             h3{
                 transform:translateY(40px)
             }
        .takes{margin-top:70px}
        .submit{
            transform:translateY(-33px);
            margin-top:50px;
            border-radius:4px
        }
                .container-fluid{
           background-image:  url(../register.jpeg);
    background-position: center;
    background-repeat:none;
    height:100vh
       }
       .register-page{
           background-color:white;
    border-radius: 5px;
    height: 400px;
    margin-bottom:20px
       }
       .pError{
            background:red;
            font-size:19px;
            color:white;
            height:50px
            
        }
    
       }
        

            @media (max-width: 320px) {
                aside{
                 display:none
             }
             h3{
                 transform:translateY(40px)
             }
        .takes{margin-top:70px}
        .submit{
            /* width:120px; */
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
      

       }
            }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 ">
            <aside><div>f<div></aside>
    </div>
    <div class="col-md-4 animated zoomInLeft">
    <form action="" method="post">
        <div class="register-page">
        <h3>LOG IN</h3>
        <p class="text-center takes">Log In to Start Keeping Track.</p>
    <div class="col-md-12">
        <div class="field">
            <input type="text" name="username" id="username" autocomplete="off" required class="form-control" placeholder="USERNAME" value="<?php echo escape(Input::get('username')) ?>">
        </div>
        </div>
        <div class="col-md-12">
        <div class="field">
            <input type="password" name="password" id="password" autocomplete="off" required class="form-control" placeholder="PASSWORD" >
        </div>
        </div>
        <div class="col-md-12">
            <div class="field">
                <input type="checkbox" name="remember" id="remeber">   Remember Me.
            </div>            <a href="register.php" class="text-center already">Back to Signup.</a>

</div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"><br>
            <button type="submit" class="btn btn-primary submit form-control">LOG IN</button>

</div>
</form>
</div>
</div>
</div>
</body>
</html>