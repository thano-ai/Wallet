<?php include('../partials/agent_menu.php') ?>


<div class="container">
        <div  class="wrapper">
               <h1>Agent Dashboard</h1>
               <br> <br>
               <?php

$servicePointId = $_SESSION['agent_id'];
// echo 'Here is'.$servicePointId;

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
               <a style="background-color:#1565C0FF ;" href="<?php echo  SITEURL; ?>agent/receive.php" class="btn btn-primary">Recieve Transaction</a>
               <br> <br> <br>


               
               <table style=";" class="table table-hover">
                  <tr class="table-active">
                  <th >No.</th>
                      <th>ID</th>
                    <th >Date</th>
                    <th >Sender Name</th>
                    <th >Reciever Name</th>
                    <th >Amount</th>
                      
                  </tr>

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


                            $sql = "SELECT * FROM transactions WHERE ServicePointId=$servicePointId ";
                            $res = sqlsrv_query($con,$sql) ;
      
                            if($res==true){
                                  $count = sqlsrv_has_rows($res) ;
                                $sn=1;
                                if($count>0){
                                  // we have data in db
                                  while ($row = sqlsrv_fetch_array($res)) {
                                        $transactionId=$row['id'];
                                        $amount=$row['amount']; 
                                        $dbAccountId =$row['AccountId']; 
                                        $dbClientId =$row['affectedId']; 
                                        $date = $row['startdate'];
                                        $newDate = $date->format('Y-m-d H:i');
            
                                        foreach ($clientsArray as $ClientId => $clientName) {
                                            if($ClientId==$dbClientId){
                                               $recieverName = $clientName;
                                            }                
                                        }

                                        foreach ($accountsArray as $accountId => $clientId) {
                                                if($accountId==$dbAccountId){
                                                   $senderClientId = $clientId;

                                                   foreach ($clientsArray as $ClientId => $clientName) {
                                                        if($ClientId==$senderClientId){
                                                           $senderName = $clientName;
                                                         //   echo $clientName ;
                                                        }                
                                                    }
                                                }                
                                            }
      


                            

                              // display in the table 
                              ?>

                              <tr >
                                <td><?php echo $sn++?></td>
                                <td><?php echo $transactionId?></td>
                                <td><?php echo $newDate?></td>
                                <td><?php echo $senderName?></td>
                                <td><?php echo $recieverName?></td>
                                <td><?php echo $amount?></td>
                              
                                
                               
                              </tr>
                              <?php
                            }   

                          }
                          else{
                            //there is no data 
                            //display message 
                            ?>
                            <tr>
                              <td colspan="6"><div class="text-danger">No Service Point Added</div></td>
                            </tr>

                            <?php 
                          }
                      }
                  
                  
                  ?>

                 
               </table>

               
            </div>
        </div>

<?php include('../partials/footer.php') ?>      