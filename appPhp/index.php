<?php 
require_once 'classes/DB.php';
$user = new User();
if($user->isLoggedIn()){ 
?>
<p> Hello <a href="#"><?php echo escape($user->data()->username);?></a>
<ul>
    <li><a href="logout.php" style="color:red">Log Out</a></li>
</ul>
<?php
}else{
    Redirect::to('login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link type="text/css" rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../budget.png">


        <title>Welcome, Start Keeping Tracks</title>
    </head>
    <body>
        
        <div class="top">
            <div class="budget">
                <div class="budget__title">
                    Available Budget in <span class="budget__title--month">%Month%</span>:
                </div>
                
                <div class="budget__value">+ 2,345.64</div>
                
                <div class="budget__income clearfix">
                    <div class="budget__income--text">Income</div>
                    <div class="right">
                        <div class="budget__income--value">+ 4,300.00</div>
                        <div class="budget__income--percentage">&nbsp;</div>
                    </div>
                </div>
                
                <div class="budget__expenses clearfix">
                    <div class="budget__expenses--text">Expenses</div>
                    <div class="right clearfix">
                        <div class="budget__expenses--value">- 1,954.36</div>
                        <div class="budget__expenses--percentage">45%</div>
                    </div>
                </div>
            </div>

        </div>
        
        
        
        <div class="container-fluid bottom">
            <div class="add">
                <div class="add__container">
                         <div class="row">
                                <div class="col-md-3 col-12">
                                <iframe name="votar" style="display:none;"></iframe>
<form action="index.php" method="post" target="votar">
                    <select class="add__type" >
                        <option value="inc" selected name="inc" id="inc">+</option>
                        <option value="exp" name="exp" name="exp" id="exp">-</option>
                    </select>
                                </div>
                            <div class="col-md-3 col-12">
                    <input type="text" class="add__description" placeholder="Add description" name="description" id="description"   >
                                </div>
                                <div class="col-md-3 col-12">
                    <input type="number" class="add__value" placeholder="Value" name="budget-amount" id="budget-amount">
                    </div>
                    <div class="col-md-3 col-12">
                    <button class="add__btn" type="submit"><i class="ion-ios-checkmark-outline"></i></button>
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
                       
                        <!--
                        <div class="item clearfix" id="income-0">
                            <div class="item__description">Salary</div>
                            <div class="right clearfix">
                                <div class="item__value">+ 2,100.00</div>
                                <div class="item__delete">
                                    <button class="item__delete--btn"><i class="ion-ios-close-outline"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="item clearfix" id="income-1">
                            <div class="item__description">Sold car</div>
                            <div class="right clearfix">
                                <div class="item__value">+ 1,500.00</div>
                                <div class="item__delete">
                                    <button class="item__delete--btn"><i class="ion-ios-close-outline"></i></button>
                                </div>
                            </div>
                        </div>
                        -->
                        
                    </div>
                </div>
                </div>
                <div class="col-md-6 col-12">
                <div class="expenses">
                    <h2 class="expenses__title">Expenses</h2>
                    <div class="expenses__list ">
                       
                        <!--
                        <div class="item clearfix" id="expense-0">
                            <div class="item__description">Apartment rent</div>
                            <div class="right clearfix">
                                <div class="item__value">- 900.00</div>
                                <div class="item__percentage">21%</div>
                                <div class="item__delete">
                                    <button class="item__delete--btn"><i class="ion-ios-close-outline"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="item clearfix" id="expense-1">
                            <div class="item__description">Grocery shopping</div>
                            <div class="right clearfix">
                                <div class="item__value">- 435.28</div>
                                <div class="item__percentage">10%</div>
                                <div class="item__delete">
                                    <button class="item__delete--btn"><i class="ion-ios-close-outline"></i></button>
                                </div>
                            </div>
                        </div>
                        -->
                        
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        
        <script src="../app.js"></script>
    </body>
</html>