<?php
include('../config/constants.php');

$subAccountId = $_GET['selected'];
$amount = $_GET['amount'];
$type = $_GET['type'];

$servicePointId = $_COOKIE['agent'];




$sql = "SELECT * FROM subAccounts WHERE id =$subAccountId ";
$res = sqlsrv_query($con, $sql);

if ($res == true) {
    $count = sqlsrv_has_rows($res);
    if ($count > 0) {
        // we have data in db
        while ($row = sqlsrv_fetch_array($res)) {
            $accountId = $row['AccountId'];
            $debit = $row['debit'];
            $credit = $row['credit'];
            $currencyType = $row['currencyType'];
            $balance = $debit - $credit;
        }


        if ($type == 1) {
                $sql2 = "UPDATE subAccounts SET
             debit = $amount+$debit
             WHERE id = $subAccountId
            ";

                //execute query
                $res2 = sqlsrv_query($con, $sql2);

                // check the query
                if ($res2 == true) {

                    $date =  date('Y-M-d h:i:s');;
                    $description = "Deposite money from agent";

                    $sql = "INSERT INTO transactions (startdate,type,description,status,amount,currency,affectedId,comission,AccountId,ServicePointId)
                   VALUES(?,?,?,?,?,?,?,?,?,?)";

                    $params = array($date,9,$description,1,$amount, $currencyType, $accountId, 100, $accountId,$servicePointId);

                    // executing query and saving the data in database
                    $res = sqlsrv_query($con, $sql, $params);

                    if($res==true){




                    $_SESSION['update'] = "<div class='text-success'>Deposite Added Successfully</div>";
                    //RETURN TO MANAGE ADMIN PAGE 
                    header("location:index.php");}
                    else{
                        die(print_r(sqlsrv_errors(), true));

                    }
                } else {
                    // failed 
                    // creat session 
                    $_SESSION['update'] = "<div class='text-danger'>Failed To Update Currency</div>";
                    //RETURN TO MANAGE ADMIN PAGE 
                    // header("location:".SITEURL.'mamageCurrencies.php') ;
                    echo "Error in statement execution.\n";
                    die(print_r(sqlsrv_errors(), true));
                }
            
        }







       else if ($type == 2) {
            if ($amount <= $balance) {
                $sql2 = "UPDATE subAccounts SET
             credit = $amount+$credit
             WHERE id = $subAccountId
            ";

                //execute query
                $res2 = sqlsrv_query($con, $sql2);

                // check the query
                if ($res2 == true) {

                    $date =  date('Y-M-d h:i:s');;
                    $description = "withdraw money from agent";

                    $sql = "INSERT INTO transactions (startdate,type,description,status,amount,currency,affectedId,comission,AccountId,ServicePointId)
                   VALUES(?,?,?,?,?,?,?,?,?,?)";

                    $params = array($date,8,$description,1,$amount, $currencyType, $accountId, 100, $accountId,$servicePointId);

                    // executing query and saving the data in database
                    $res = sqlsrv_query($con, $sql, $params);

                    if($res==true){




                    $_SESSION['update'] = "<div class='text-success'>Deposite Added Successfully</div>";
                    //RETURN TO MANAGE ADMIN PAGE 
                    header("location:index.php");}
                    else{
                        die(print_r(sqlsrv_errors(), true));

                    }
                } else {
                    // failed 
                    // creat session 
                    $_SESSION['update'] = "<div class='text-danger'>Failed To Update Currency</div>";
                    //RETURN TO MANAGE ADMIN PAGE 
                    // header("location:".SITEURL.'mamageCurrencies.php') ;
                    echo "Error in statement execution.\n";
                    die(print_r(sqlsrv_errors(), true));
                }
            }
        }
    }
}
