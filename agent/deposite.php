<?php include('../partials/agent_menu.php') ?>


<div class="container">
   <div class="wrapper">
      <h1>Deposite & Withdraw</h1>
      <br> <br>
      <?php

      $servicePointId = $_COOKIE['agent'];


      if (isset($_SESSION['add'])) {
         echo $_SESSION['add'];
         unset($_SESSION['add']); //display just one time 
      }
      if (isset($_SESSION['delete'])) {
         echo $_SESSION['delete'];
         unset($_SESSION['delete']); //display just one time 
      }
      if (isset($_SESSION['update'])) {
         echo $_SESSION['update'];
         unset($_SESSION['update']); //display just one time 
      }
      if (isset($_SESSION['noUser'])) {
         echo $_SESSION['noUser'];
         unset($_SESSION['noUser']); //display just one time 
      }
      if (isset($_SESSION['change'])) {
         echo $_SESSION['change'];
         unset($_SESSION['change']); //display just one time 
      }
      if (isset($_SESSION['noMatch'])) {
         echo $_SESSION['noMatch'];
         unset($_SESSION['noMatch']); //display just one time 
      }

      if (isset($_SESSION['no-admin-found'])) {
         echo $_SESSION['no-admin-found'];
         unset($_SESSION['no-admin-found']); //display just one time 
      }

      ?>
      <!-- <br><br> -->

      <!-- button to add admin -->
      <br>

      <form method="POST" style="width: 40%;" class="d-flex">
         <input class="form-control me-sm-2" type="text" name="searchText" placeholder=" Enter phone, account No. or Client No." value="<?php ?>">
         <button name="find" class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>


      
      <?php
      // display from database





      if (isset($_POST['find'])) {
         $found = false;



         $search = $_POST['searchText'];

         $length = strlen($search);
         if ($length > 9) {
            $tempClient = 99909;
         } else {
            $tempClient = $search;
         }

         $sql = "SELECT * FROM clients WHERE ClientId ='$tempClient' OR phone = '$search' ";
         $res = sqlsrv_query($con, $sql);

         if ($res == true) {
            $count = sqlsrv_has_rows($res);
            if ($count > 0) {
//               $found = true;
               // we have data in db
               while ($row = sqlsrv_fetch_array($res)) {
                  $clientId = $row['ClientId'];
                  $name = $row['firstName'] . " " . $row['lastName'];
                  $phone = $row['phone'];
                  // echo  $name . " " . $phone;


                  $sql = "SELECT * FROM accounts WHERE clientId=$clientId ";
                  $res = sqlsrv_query($con, $sql);

                  if ($res == true) {
                     $count = sqlsrv_has_rows($res);
                     if ($count > 0) {
                        $found = true;


                        // we have data in db
                        while ($row = sqlsrv_fetch_array($res)) {
                           $clientId = $row['clientId'];
                           $accountId = $row['AccountId'];

                           // echo "Here is:" . $clientId . $accountId;


                           $sql = "SELECT * FROM subAccounts WHERE AccountId =$accountId ";
                           $res = sqlsrv_query($con, $sql);

                           if ($res == true) {
                              $count = sqlsrv_has_rows($res);
                              if ($count > 0) {
                                 // we have data in db
                                 while ($row = sqlsrv_fetch_array($res)) {
                                    // echo "Currencies are:". $row['currencyType'];
                                    $subAccountArray[$row['id']] = $row['currencyType'];
                                    $balanceArray[$row['id']] = $row['debit'];
                                 }
                                 echo '</br>';
                              }
                           }
                        }
                     }
                     else{
                        echo '  <tr>
                        <td colspan="6">
                           <div class="text-danger">No Account Found for this client</div>
                        </td>
                     </tr>';
                     }
                  }
               }
            } else {



               $sql = "SELECT * FROM accounts WHERE AccountId='$search' ";
               $res = sqlsrv_query($con, $sql);

               if ($res == true) {
                  $count = sqlsrv_has_rows($res);
                  if ($count > 0) {
                     $found = true;


                     // we have data in db
                     while ($row = sqlsrv_fetch_array($res)) {
                        $clientId = $row['clientId'];
                        $accountId = $row['AccountId'];

                        // echo "Here is:" . $clientId . $accountId;


                        $sql = "SELECT * FROM subAccounts WHERE AccountId =$accountId ";
                        $res = sqlsrv_query($con, $sql);

                        if ($res == true) {
                           $count = sqlsrv_has_rows($res);
                           if ($count > 0) {
                              // we have data in db
                              while ($row = sqlsrv_fetch_array($res)) {
                                 $subAccountArray[$row['id']] = $row['currencyType'];
                              }
                           }
                        }



                        $sql = "SELECT * FROM clients WHERE ClientId =$clientId ";
                        $res = sqlsrv_query($con, $sql);

                        if ($res == true) {
                           $count = sqlsrv_has_rows($res);
                           if ($count > 0) {
                              // we have data in db
                              while ($row = sqlsrv_fetch_array($res)) {
                                 $name = $row['firstName'] . " " . $row['lastName'];
                                 $phone = $row['phone'];
                                 // echo  $name . " " . $phone;
                              }
                           }
                        }
                     }
                  } else {
                     echo '  <tr>
                 <td colspan="6">
                    <div class="text-danger">No client Found</div>
                 </td>
              </tr>';
                  }
               }
            }
         }

         if($found){



            echo " <form style='width:50%' action='depositeProccess.php' method='GET'>
            <table class='table table-hover'>


            <tr style='border-bottom:  0px solid white; margin-top:20px ' >
            <td>   <h3> Customer Information </h3></td>
             </tr>
             <tr> <td>  <h5> Account No: $accountId </h5> </td></tr>
        
                <tr>
                <td>Name</td>
                <td><input class='form-control'  style='margin-left:-90%; font-size:15px'  type='text'  value=$name></td>
                </tr>
                <tr>

                <td>Phone Number</td>
                <td><input class='form-control' style='margin-left:-90%; font-size:15px'  type='text'  value=$phone></td>
                </tr>

                <td>Amount</td>
                <td><input class='form-control' style='margin-left:-90%; font-size:15px'  type='text' name='amount'></td>
                </tr>
                <tr>
                <td>
                <select name='selected' style='width:55%; height:6%;font-size:15px' class='form-select form-select-lg mb-6' aria-label='.form-select-lg example'>
  <option selected>Select Currency</option>";
                
                foreach ($subAccountArray as $subAccountId2 => $currency) {
                ?>
                
                <option value = "<?php echo $subAccountId2; ?>"><?php echo $currency; ?></option>

<?php } ?>
</select >
                </td>

                <td>
<select name='type' style='width:100%; height:6%;font-size:15px;margin-left:-70%' class='form-select form-select-lg mb-6' aria-label='.form-select-lg example'>
  <option selected>Transaction Type</option>
  <option value = "1">Deposite</option>
  <option value = "2">Withdraw</option>
  </select >
                </td>
                </tr>
                </table> 


  <button style="background-color:#278abd ;" name="" class="btn btn-secondary my-2 my-sm-0" type="submit">Confirm</button>

                <?php
               echo" 
            </form>";
            ?>

            <?php
         }
      } else {
         die(print_r(sqlsrv_errors(), true));
      }




      
      ?>


      </tr>
      





   </div>
</div>

<?php include('../partials/footer.php') ?>