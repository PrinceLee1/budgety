<?php 
require_once 'classes/DB.php';
$user = new User();
if($user->isLoggedIn()){ 
?>
<?php
}else{ Redirect::to('login.php');}
?>
  <?php $conn = new mysqli("localhost", "newuser", "password", "budgety");$status =$user->data()->username; $Sql = "SELECT * FROM income WHERE user_id='$status' "; $result = mysqli_query($conn, $Sql); $results = mysqli_query($conn,"SELECT SUM(income_amount) AS income_amount FROM income WHERE user_id='$status'"); 
  $row = mysqli_fetch_assoc($results);  $sum = $row['income_amount'];$expense = mysqli_query($conn,"SELECT SUM(expense_amount) AS expense_amount FROM expenses WHERE user_id='$status'"); $expRow = mysqli_fetch_assoc($expense);$minus = $expRow['expense_amount']; $calculateBudget = $sum - $minus; $percentage = ($sum * 100)/$calculateBudget;?>
                       
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link type="text/css" rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../css/responsive.css">

        <link rel="shortcut icon" href="../budget.png">


        <title>Welcome, Start Keeping Tracks</title>
    </head>
    <body>
    <div class="container-fluid tops">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <h3 class="text-center text-uppercase" style="color:#FF5049">-- Welcome <?php echo $user->data()->username;?> --</h3>
                <p class="text-center" style="color:white">Please start keeping Track of your<br> Income and Expenses. Let's help you curtail your spending.</p>
                <h4 class="text-center" style="color:#28B9B5">-- When you are done you can <a href="logout.php" style="color:#FF5049;">Log Out Here</a> --</h4>
</div>
        <div class="col-lg-8 col-sm-6 col-xs-12">
        <div class="top">
            <div class="budget">
                <div class="budget__title">
            
                    Available Budget in <span class="budget__title--month">%Month%</span>:
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
        <div class="container-fluid bottom">
            <div class="add">
                <div class="add__container">
                         <div class="row">
                                <div class="col-md-3 col-12">
                                <!-- <iframe name="votar" style="display:block;"></iframe> -->
<form action="action.php" method="post" >
                    <select class="add__type" name="read" >
                        <option value="inc" selected name="inc" id="inc">+</option>
                        <option value="exp" name="exp" name="exp" id="exp">-</option>
                    </select>
                                </div>
                            <div class="col-md-3 col-12">
                    <input type="text" class="add__description" placeholder="Add description" name="description" id="description" required  >
                                </div>
                                <div class="col-md-3 col-12">
                    <input type="number" class="add__value" placeholder="Value" name="budget-amount" id="budget-amount" required>
                    </div>
                    <div class="col-md-3 col-12">
                    <button class="add__btn" type="submit" name="check"><i class="ion-ios-checkmark-outline"></i></button>
                    </div>
</form>
                    </div>
                </div>
            </div>

            <div class="container-fluid clearfix">
                <div class="row">
                    <div class="col-md-6 col-12">
                <div class="income">
                    <h2 class="icome__title">Income</h2>
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
                            <td>" . $row['month']."</td></tr>";       
                        }
                       
                        echo "</tbody></table>";
                      
                      
    }else{
        echo 'No records Found';
    }
                 ?>     

                    </div>
                </div>
                </div>
                <div class="col-md-6 col-12">
                <div class="expenses">
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
                                <th scope='col'>TIME</th>
                              </tr>
                            </thead>
                            <tbody>";
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row['expense_description']."</td>
                                          <td>" .'₦'. $row['expense_amount']."</td>
                                          <td>" . $row['month']."</td></tr>";        
                            }
                           
                            echo "</tbody></table>";
                          
        }else{
            echo 'No records Found';}
                            
                       ?>
                        
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
    <!-- <footer class="text-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        Made with  <i class="fa fa-heart" style="color: red;"></i>  By <span> Prince Lee.</span>
                    </p>
                </div>
            </div>
        </div>

      

    </footer> -->
        <!-- <script src="../app.js"></script> -->
    </body>
</html>