<?php
if(isset($_POST['read'])){
    $select1 = $_POST['read'];
    switch ($select1) {
        case 'inc':
            require_once 'classes/DB.php';
if(isset($_POST['check'])){
    $des = $_POST['description'];
    $amount = $_POST['budget-amount'];
    $user = new User();
              $user_id=  $user->data()->username;
           $month=   date('Y-m-d H:i:s');
             try{
                 $user->insertIncome(array(
                    'income_description' => $des,
                    'income_amount' => $amount,
                    'user_id' => $user_id,
                    'month' => $month
                 ));
                 Redirect::to('index.php');
             }catch(Exception $e){
                die($e->getMessage());

             }

    }else{
    echo 'description';
}
            break;
        case 'exp':
            require_once 'classes/DB.php';
if(isset($_POST['check'])){
    $des = $_POST['description'];
    $amount = $_POST['budget-amount'];
    $user = new User();
              $user_id=  $user->data()->username;
           $month=   date('Y-m-d H:i:s');
             try{
                 $user->insertExpenses(array(
                    'expense_description' => $des,
                    'expense_amount' => $amount,
                    'user_id' => $user_id,
                    'month' => $month
                 ));
                 Redirect::to('index.php');
             }catch(Exception $e){
                die($e->getMessage());

             }

    }else{
    echo 'description';
}            break;
        default:
            # code...
            break;
    }
}



?>