<?php
require_once 'classes/DB.php';
 
if(Input::exists()){
    if(Token::check(Input::get('token'))){
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
        'repeat-password' => array(
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
    $user = new User();
    //  var_dump($user);exit;
    $salt = Hash::salt(32);
            try{
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => 1

                ));
                Redirect::to('index.php');
                echo "<p class='text-center pError'>Thank you for using Budgety, please Login to Continue</p>";
            }catch(Exception $e){
        die($e->getMessage());
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

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="../css/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl-carousel/owl.theme.default.min.css">
    <title>Get Started | Earn, Spend and Keep Track</title>
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
        .takes{color:gray;margin-top:24px}
        .form-control{
            margin-top:20px;
            height:40px;
          border-top:1px solid #f41366;
          border-bottom:0px;
          border-right:0px; border-left:0px
        }
        .pError{
            background:red;
            font-size:23px;
            color:white;
            height:50px
            
        }
        a{
            color:#28B9B5;float:right;transform:translateY(-30px);
            margin-right:60px;font-size:15px;text-decoration:none

        }
        .submit{
            margin-bottom:18px;
            width:100%;
            height:45px;
            /* margin-left:40px; */
            background-color:#f41366;
            color:white;
            border:0px;
            cursor:pointer;
            border-radius:18px
        }
        .submit:hover{
            background-color:#28B9B5
        }
        .user-img{
          height:637px;
          width:850px;
transform:translateX(-46px)
        }
        .user{
            margin-top:10px;
            margin-left:100px;
            border:12px solid grey;
            border-radius:65px
        }
        img{
            background: rgba(0, 0, 0, 0.9)   }
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
                    background-image:  url(../register.jpg);
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
            /* width:150px; */
            margin-top:20px
        }
                .container-fluid{
           background-image:  url(../register.jpeg);
    background-position: center;
    /* background-repeat:no-repeat; */
    height:100vh
       }
       .register-page{
           background-color:white;
    border-radius: 5px;
    height: 480px;
    margin-bottom:20px
       }
       .already{
           margin-left:10px
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
            /* width:100px; */
            margin-top:20px
        }
                .container-fluid{
           background-image:  url(../register.jpg);
    background-position: center;
    /* background-repeat:no-repeat;0 */
    height:100vh
       }
       .register-page{
           background-color:white;
    border-radius: 5px;
    height: 480px;
    margin-bottom:20px
       }
       .already{
           margin-left:10px
       }
    
            }
    </style>
</head>
<body>
 <div class="container-fluid" style="background-color:#fffafa">
     <div class="row">
         <div class="col-md-8">
             <img src="../stats-bg.jpg" alt="signup" class="user-img">
    </div>
         <div class="col-md-4 animated zoomInLeft">
    <form action="" method="post" class="form-group">
         <div class="register-page">
            <h3>GET STARTED</h3>
            <p class="text-center takes">It takes no time to get you Started.</p>
            <div class="col-md-12">
    <div class="field">
  <input type="text" name="username" id="username" autocomplete="off" value="<?php echo escape(Input::get('username')) ?>" placeholder="USERNAME" class="form-control" required>
    </div>
    </div>
    <div class="col-md-12">
    <div class="field">
    <input type="password" name="password" id="password" autocomplete="off" value="<?php echo escape(Input::get('password')) ?>" placeholder="PASSWORD" class="form-control" required>
    </div>
    </div>
    <div class="col-md-12">
    <div class="field">
    <input type="password" name="repeat-password" id="repeat-password" value="<?php echo escape(Input::get('repeat-password')) ?>" placeholder="REPEAT PASSWORD" class="form-control" required>
    </div>
    </div>
    <div class="col-md-12">
    <div class="field">
    <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')) ?>" placeholder="FULL NAME" class="form-control" required>
    </div>
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
    <button type="submit"  class=" btn btn-primary submit" class="form-control">REGISTER</button><br>
  
   <p class="already">Already have an Account?</p> <a href="login.php">Sign In.</a>

       </div>
    </form>
    </div>
    </div>
    </div>
</body>
</html>