<?php include('../partials/agent_menu.php') ?>


<div class="container">
        <div  class="wrapper">
               <h1>Receive Transaction</h1>
               <br> <br>
               <?php

$servicePointId = $_COOKIE['agent'];


               if(isset($_SESSION['add'])){
                  echo $_SESSION['add'] ;
                  unset($_SESSION['add']) ; //display just one time 
               }
               if(isset($_SESSION['delete'])){
                  echo $_SESSION['delete'] ;
                  unset($_SESSION['delete']) ; //display just one time 
               }
               if(isset($_SESSION['update'])){
                  echo $_SESSION['update'] ;
                  unset($_SESSION['update']) ; //display just one time 
               }
               if(isset($_SESSION['noUser'])){
                  echo $_SESSION['noUser'] ;
                  unset($_SESSION['noUser']) ; //display just one time 
               }
               if(isset($_SESSION['change'])){
                  echo $_SESSION['change'] ;
                  unset($_SESSION['change']) ; //display just one time 
               }
               if(isset($_SESSION['noMatch'])){
                  echo $_SESSION['noMatch'] ;
                  unset($_SESSION['noMatch']) ; //display just one time 
               }

               if(isset($_SESSION['no-admin-found'])){
                  echo $_SESSION['no-admin-found'] ;
                  unset($_SESSION['no-admin-found']) ; //display just one time 
               }


               ?>
               <!-- <br><br> -->

               <!-- button to add admin -->
               <br> <br>

               <form method="POST" style="width: 40%;" class="d-flex">
        <input class="form-control me-sm-2" type="text" name="searchText" placeholder=" Enter receiver phone or transaction No." value="<?php ?>">
        <button  style="background-color:#1565C0FF ;" name="find" class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
               

                  <?php
                      // display from database
                      $sql = "SELECT * FROM clients ";
                      $res = sqlsrv_query($con,$sql) ;

                      if($res==true){
                            $count = sqlsrv_has_rows($res) ;
                          if($count>0){
                            // we have data in db
                            while($row = sqlsrv_fetch_array($res)){
                              // get the data 
                              $clientsArray[$row[0]] = $row[1] . " " . $row[4];
                              $phoneArray[$row[0]] = $row['phone'];

                            }
                        }}


                        $sql = "SELECT * FROM accounts ";
                        $res = sqlsrv_query($con,$sql) ;
  
                        if($res==true){
                              $count = sqlsrv_has_rows($res) ;
                            if($count>0){
                              // we have data in db
                              while($row = sqlsrv_fetch_array($res)){
                                // get the data 
                                $accountsArray[$row['AccountId']] = $row['clientId'] ;
                              }
                          }}


              
                          

                 
             
              
              if (isset($_POST['find'])) {


               $id = $_POST['searchText'];
               $sql = "SELECT * FROM transactions WHERE id= $id";
               $res = sqlsrv_query($con,$sql) ;

               if($res==true){
                     $count = sqlsrv_has_rows($res) ;
                   $sn=1;
                   if($count>0){
                     // we have data in db
                     while ($row = sqlsrv_fetch_array($res)) {
                        $status = $row['status'];
                        if($status==1){
                           echo '<h3 style="color:red">its already recieved</h3>';

                           return;
                        }
                           $transactionId=$row['id'];
                           $amount=$row['amount']; 
                           $dbAccountId =$row['AccountId']; 
                           $dbClientId =$row['affectedId']; 
                           $date = $row['startdate'];
                           $newDate = $date->format('Y-m-d H:i');

                           foreach ($clientsArray as $ClientId => $clientName) {
                               if($ClientId==$dbClientId){
                                  $recieverName = $clientName;

                                  foreach ($phoneArray as $ClientId => $phone) {
                                    if($ClientId==$dbClientId){
                                       $receiverPhone = $phone;
                                    }                
                                }


                               }                
                           }

                           foreach ($accountsArray as $accountId => $clientId) {
                                   if($accountId==$dbAccountId){
                                      $senderClientId = $clientId;

                                      foreach ($clientsArray as $ClientId => $clientName) {
                                           if($ClientId==$senderClientId){
                                              $senderName = $clientName;
                                              foreach ($phoneArray as $ClientId => $phone) {
                                                if($ClientId==$senderClientId){
                                                   $senderPhone = $phone;
                                                }                
                                            }
                                           }                
                                       }
                                   }                
                               }

                               
                               echo " <form action='changeStatusProccess.php' method='POST'>
                               <table class='table table-hover'>
                 
                               <tr style='border-bottom:  0px solid white; margin-top:20px ' >
                               <td>   <h3> Sender Information </h3></td>
                                </tr>
                           
                 
                                <input class='form-control' hidden style='margin-left:-110%' type='text' name='transactionId' value=$id>
                                   <tr>
                                   <td>Name</td>
                                   <td><input class='form-control' style='margin-left:-110%' type='text' name='senderName' value=$senderName></td>
                                   <td>Phone Number</td>
                                   <td><input class='form-control'  type='text' name='senderPhone' value=$senderPhone></td>
                                   </tr>
                 
                 
                                 
                                   <tr style='border-bottom:  0px solid white; margin-top:20px ' >
                                   <td> <h3> Receiver Information </h3></td>
                                    </tr>
                                       <tr>
                                       <td>Name</td>
                                       <td><input class='form-control' style='margin-left:-110%' type='text' name='receiverName' value=$recieverName></td>
                                       <td>Phone Number</td>
                                       <td><input class='form-control' type='text' name='receiverPhone'value=$receiverPhone></td>
                                       </tr>

                                       <tr>
                                       <td>Date</td>
                                       <td><input class='form-control' style='margin-left:-110%' type='text' name='receiverName' value=$newDate></td>
                                       <td>Amount</td>
                                       <td><input class='form-control' type='text' name='receiverPhone'value=$amount></td>
                                       </tr>
                 
                                      
                                       
                 
                                  
                 
                                   <!-- <tr>
                                   <td>Birthdate</td>
                                   <td><input class='form-control' type='text' name='bithdate' value=''></td>
                                   </tr> -->
                 
                                 
                               </table>
                               <div class='form-group'>
                               <input type='hidden' name='transactionId' value='<?php echo $id ;?>'>
                               <a style='background-color:red; padding 10px' href='changeStatusProccess.php?id=$id&servicePointId=$servicePointId' title=''>Recieve</a>
                                <div>
                 
                 
                           </form>";



               

                 // display in the table 
                 ?>

             <!--    <tr >
                   <td><?php echo $sn++?></td>
                   <td><?php echo $transactionId?></td>
                   <td><?php echo $newDate?></td>
                   <td><?php echo $senderName?></td>
                   <td><?php echo $recieverName?></td>
                   <td><?php echo $amount?></td>
                 
                   
                  
                 </tr> -->
                 <?php
               }   

             }
             else{
               //there is no data 
               //display message 
               ?>
               <tr >
                 <td colspan="6"><div class="text-danger">No Remittance Found</div></td>
               </tr>


               <?php 
             }
         }
     
     
     


            
              }
              
              ?>
               
            </div>
        </div>

<?php include('../partials/footer.php') ?>      