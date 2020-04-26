<?php 
require_once 'classes/DB.php';
$user = new User();
if($user->isLoggedIn()){ 
?>
<?php
}else{ Redirect::to('login.php');}
?>
  <?php $conn = new mysqli("localhost", "newuser", "password", "budgety");
  $searched = date('F Y');
  $status =$user->data()->username;
  $email = $user->data()->email;
   $Sql = "SELECT * FROM income WHERE user_id='$status' ";
   $fetchEmail = "SELECT * FROM users WHERE user_id='$status' AND email='$email'";

    $result = mysqli_query($conn, $Sql);
     $results = mysqli_query($conn,"SELECT SUM(income_amount) AS income_amount FROM income WHERE user_id='$status' AND searched_month='$searched'"); 
  $row = mysqli_fetch_assoc($results); 
   $sum = $row['income_amount'];
  
  $expense = mysqli_query($conn,"SELECT SUM(expense_amount) AS expense_amount FROM expenses WHERE user_id='$status' AND searched_month='$searched'");
   $expRow = mysqli_fetch_assoc($expense);$minus = $expRow['expense_amount']; 
   $calculateBudget = $sum - $minus; $percentage = ($calculateBudget * 100)/$sum;
  
  
  ?>
                       
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"> -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link type="text/css" rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../css/responsive.css" type="text/css">
        <link rel="stylesheet" href="../css/animate/animate.min.css">
        <link rel="shortcut icon" href="../budget.png">

        <title>Welcome <?php echo $status?>, Start Keeping Tracks</title>
    </head>
    <style>
        .tablearea{
    background: #28B9B5;
}
.tab2{
    background: #FF5049;

}
input[type="search"] {
  width: 130px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
input[type=search]:focus {
  width: 100%;
  border: 1px solid #FF5049;

}
.alert{
    margin-top:18px;
    padding:20px
}
.tops a{
    text-decoration:none
}
@media (max-width: 320px) {
    .logout{
        margin-top:55px;
        font-size:15px !important
    }
        h3{
            font-size:20px
        }
        table{
         transform:translateX(-9px)
        }
    }

    </style>
    <body>
    <div class="container-fluid tops">
        <div class="row">
            <div class="col-md-4 ">
                <h3 class="text-center text-uppercase " style="color:#FF5049">-- Welcome <?php echo $user->data()->username;?> --</h3>
                <p class="text-center" style="color:white">Please start keeping Track of your<br> Income and Expenses. Let's help you save your spending and earning.</p>  
                <p class="text-center" style="color:#FF5049">-- You registered on <span style="color:#28B9B5"><?php echo $user->data()->joined;?></span> --</p>
            
</div>

        <div class="col-lg-8 col-sm-6 col-xs-12 animated bounce ">
        <div class="top">
            <div class="budget">
                <div class="budget__title">
            
                  <b>  Available Budget in <span class="budget__title--month">: <?php echo date('F Y'); ?></span></b>
                </div>
                
                <div class="budget__value"><?php echo '₦'.$calculateBudget;?></div>
                
                <div class="budget__income clearfix">
                    <div class="budget__income--text">Income</div>
                    <div class="right">
                        <div class="budget__income--value"><?php echo '₦'.$sum;?></div>
                        <div class="budget__income--percentage">&nbsp;</div>
                    </div>
                </div>
                
                <div class="budget__expenses clearfix">
                    <div class="budget__expenses--text">Expenses</div>
                    <div class="right clearfix">
                        <div class="budget__expenses--value"><?php echo '₦'.$minus;?></div>
                        <div class="budget__expenses--percentage"><?php echo round($percentage).'%'?></div>
                        
                    </div>
                </div>
            </div>
</div>

        </div>
    </div>
        </div>
        
        <h4 class="text-center logout" style="color:#28B9B5;font-size:16px">-- When you are done you can <a href="logout.php" style="color:#FF5049;" >Log Out Here</a> --</h4>

        <section id="hide">
        <div class="container-fluid bottom">
            <div class="add">
                <div class="add__container">
                         <div class="row">
                                <div class="col-md-3 col-12">
                                <!-- <iframe name="votar" style="display:block;"></iframe> -->
<form action="action.php" method="post" >
                    <select class="add__type" name="read" >
                        <option value="inc" selected name="inc" id="inc">+ Income</option>
                        <option value="exp" name="exp" name="exp" id="exp">- Expense</option>
                    </select>
                                </div>
                            <div class="col-md-3 col-12">
                    <input type="text" class="add__description" placeholder="Add description" name="description" id="description" required  >
                                </div>
                                <div class="col-md-3 col-12">
                    <input type="number" class="add__value" placeholder="Value" name="budget-amount" id="budget-amount" required>
                    </div>
                    <div class="col-md-3 col-12">
                    <button class="add__btn" type="submit" name="check"><i class="fa fa-check-circle"></i></button>
                    </div>
</form>

                    </div>
                </div>
            </div>

            <div class="container-fluid clearfix tablearea">
                <div class="row">
                    <div class="col-md-6 col-12">
                <div class="income animated bounceInUp">
                    <h2 class="icome__title" style="color:white !important">Income</h2>
                    <div class="income__list">
                    <?php
                     if (mysqli_num_rows($result) > 0) {
                        echo "<table class='table table-striped table-success'>
                        <thead>
                          <tr>
                            <th scope='col'>INCOME DESCRIPTION</th>
                            <th scope='col'>AMOUNT</th>
                            <th scope='col'>MONTH</th>
                          </tr>
                        </thead>
                        <tbody>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>" . $row['income_description']."</td>
                            <td>" .'₦'. $row['income_amount']."</td>
                            <td>" . $row['searched_month']."</td></tr>";       
                        }
                       
                        echo "</tbody></table>";
                      
                      
    }else{
        echo '<p class="text-center" style="color:white"><i>No records so far!</i></p>';
    }
                 ?>     

                    </div>
                </div>
                </div>
                <div class="col-md-6 col-12">
                <div class="expenses animated bounceInUp">
                    <h2 class="expenses__title">Expenses</h2>
                    <div class="expenses__list ">
                       
                    <?php
                $conn = new mysqli("localhost", "newuser", "password", "budgety");
                        $status =$user->data()->username;
                         $Sql = "SELECT * FROM expenses WHERE user_id='$status' ";
                         $result = mysqli_query($conn, $Sql);
                         if (mysqli_num_rows($result) > 0) {
                            echo "<table class='table table-striped table-danger'>
                            <thead>
                              <tr>
                                <th scope='col'>EXPENSE DESCRIPTION</th>
                                <th scope='col'>AMOUNT</th>
                                <th scope='col'>MONTH</th>
                              </tr>
                            </thead>
                            <tbody>";
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row['expense_description']."</td>
                                          <td>" .'₦'. $row['expense_amount']."</td>
                                          <td>" . $row['searched_month']."</td></tr>";        
                            }
                           
                            echo "</tbody></table>";
                          
        }else{
            echo '<p class="text-center" style="color:white"><i>No records so far!</i></p>';
        }
                            
                       ?>
                        
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    
        </div>
                </div>
                
            </div>
            
            </div>
        </div>
        
        </section>
        <?php
        if(isset($_POST['searchMonth'])){
    require_once 'classes/DB.php';
    $user1 = new User();
    $user_id1=  $user1->data()->username;
    $monthSearch = $_POST['month-search'];
    // echo $hh;exit;
    if(!empty($monthSearch)){
        $database = new Database();
        $sql = "SELECT * FROM income WHERE searched_month='$monthSearch' AND user_id='$user_id1'";
        $sql1 = "SELECT * FROM expenses WHERE searched_month='$monthSearch' AND user_id='$user_id1'";
        $selMonth1 = $database->runQuery($sql1);
        $selMonth = $database->runQuery($sql);

        if(mysqli_num_rows($selMonth) > 0){
            echo "<script type='text/javascript'>
            document.getElementById('hide').style.display = 'none';
            </script>";
            echo "<div class='container-fluid tab2'>";
            echo "<h3 class='text-center' style='color:white'><b>THIS IS THE AVAILABLE BUDGET FOR THE MONTH OF $monthSearch</b></h3>";
            echo "<table class='table table-striped table-success col-md-6'>
            <thead>
              <tr>
                <th scope='col'>INCOME DESCRIPTION</th>
                <th scope='col'>AMOUNT</th>
                <th scope='col'>TIME</th>
              </tr>
            </thead>
            <tbody>";
            while($row = mysqli_fetch_assoc($selMonth)) {
                echo "<tr><td>" . $row['income_description']."</td>
                          <td>" .'₦'. $row['income_amount']."</td>
                          <td>" . $row['month']."</td></tr>";        
            }
           
            echo "</tbody></table>";        }else{ 
                echo "<div class='alert alert-danger alert-dismissible text-center' style='background:red'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close' style='color:white'>&times;</a>
          <b style='color:white'>Sorry no records found<br> for $monthSearch!</b>  </div>";        }
        if(mysqli_num_rows($selMonth1) > 0){
            echo "<table class='table table-striped table-danger col-md-6'>
            <thead>
              <tr>
                <th scope='col'>EXPENSE DESCRIPTION</th>
                <th scope='col'>AMOUNT</th>
                <th scope='col'>TIME</th>
              </tr>
            </thead>
            <tbody>";
            while($row = mysqli_fetch_assoc($selMonth1)) {
                echo "<tr><td>" . $row['expense_description']."</td>
                          <td>" .'₦'. $row['expense_amount']."</td>
                          <td>" . $row['month']."</td></tr>";        
            }
           
            echo "</tbody></table>";   }
            $sql2 = "SELECT SUM(income_amount) AS income_amount FROM income WHERE user_id='$status' AND searched_month='$monthSearch' ";
            $sql3 = "SELECT SUM(expense_amount) AS expense_amount FROM expenses WHERE user_id='$status' AND searched_month='$monthSearch' ";
            $calc1 = $database->runQuery($sql3);
            $getExpCalc = mysqli_fetch_assoc($calc1);
            $sumExpCalc = $getExpCalc['expense_amount'];

            $calc = $database->runQuery($sql2);
            $getCalc = mysqli_fetch_assoc($calc);
            $sumCalc = $getCalc['income_amount'];
            echo "<p class='text-center' style='color:white'>Total Income is :₦$sumCalc</p>";
            echo "<p class='text-center' style='color:white'>Total Expenses is :₦$sumExpCalc</p>";

    echo "</div>";


}
}


?>

<form action="" method="post" id="sech">
        <div class="col-md-3 ">
                <b class="text-center">Please make sure to add<br> the year in full when searching.</b>
                <input type="search" id="month-search" name="month-search" class="form-control" placeholder="Search budget for any month" required style="margin-bottom:12px">
<input type="submit" class="form-control btn btn-primary" name="searchMonth" value="Search">
</div>
  </form>


    <footer class="text-center" style="margin-top:120px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        Made with  <i class="fa fa-heart animated flash infinite" style="color: red;"></i>  By <span> Prince Lee.</span>
                    </p>
                </div>
            </div>
        </div>

      

    </footer>
        <!-- <script src="../app.js"></script> -->
    </body>
</html>
