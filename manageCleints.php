<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Manage Cleints</h1>
               <br> <br>
               <?php
<<<<<<< HEAD
<<<<<<< HEAD
            //    if(isset($_SESSION['add'])){
            //       echo $_SESSION['add'] ;
            //       unset($_SESSION['add']) ; //display just one time 
            //    }
            //    if(isset($_SESSION['delete'])){
            //       echo $_SESSION['delete'] ;
            //       unset($_SESSION['delete']) ; //display just one time 
            //    }
=======
>>>>>>> c882d4c (init2)
=======
               if(isset($_SESSION['add'])){
                  echo $_SESSION['add'] ;
                  unset($_SESSION['add']) ; //display just one time 
               }
               if(isset($_SESSION['delete'])){
                  echo $_SESSION['delete'] ;
                  unset($_SESSION['delete']) ; //display just one time 
               }

>>>>>>> ece5bf3 (deposite)
               if(isset($_SESSION['update'])){
                  echo $_SESSION['update'] ;
                  unset($_SESSION['update']) ; //display just one time 
               }
<<<<<<< HEAD
<<<<<<< HEAD
            //    if(isset($_SESSION['noUser'])){
            //       echo $_SESSION['noUser'] ;
            //       unset($_SESSION['noUser']) ; //display just one time 
            //    }
            //    if(isset($_SESSION['change'])){
            //       echo $_SESSION['change'] ;
            //       unset($_SESSION['change']) ; //display just one time 
            //    }
            //    if(isset($_SESSION['noMatch'])){
            //       echo $_SESSION['noMatch'] ;
            //       unset($_SESSION['noMatch']) ; //display just one time 
            //    }

            //    if(isset($_SESSION['no-admin-found'])){
            //       echo $_SESSION['no-admin-found'] ;
            //       unset($_SESSION['no-admin-found']) ; //display just one time 
            //    }
=======
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
>>>>>>> ece5bf3 (deposite)


               ?>
               <br><br>

               <!-- button to add admin -->
               <!-- <a href="<?php echo  SITEURL; ?>addServicePoint.php" class="btn-primary">Add Service Point</a> -->
               <!-- <br> <br> <br> -->
<<<<<<< HEAD
=======
               ?>
               <br>
>>>>>>> c882d4c (init2)
=======
               <br>
>>>>>>> ece5bf3 (deposite)

               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Name</th>
                      <!-- <th>Birthdate</th>
                      <th>Gender</th> -->
                      <th>Status</th>
                      <th>Phone</th>
                      <th>Type</th>
                      <!-- <th>Photo</th> -->
                      <th>Process</th>
                      
                  </tr>

                  <?php
                      // display from database
                      $sql = "SELECT * from clients" ;
                      $res = sqlsrv_query($con,$sql) ;

                      if($res==true){
                            $count = sqlsrv_has_rows($res) ;
                          $sn=1;
                          if($count>0){
                            // we have data in db
                            while($rows = sqlsrv_fetch_array($res)){
                              // get the data 
                              $id = $rows['ClientId'] ; 
                              $firstname = $rows['firstName'] ;
                              $lastname = $rows['lastName'] ;
                              // $bithdate = $rows['birthDate'] ;
                              // $gender = $rows['gender'] ;
                              $status = $rows['status'] ;
                              $phone = $rows['phone'] ;
                              $type = $rows['type'] ;
                              // $photo = $rows['photo'] ;
                              
                              
                              // $convertedDate = $bithdate->format('Y-m-d ');

                              // display in the table 
                              ?>

                              <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $firstname , $lastname ?></td>
                                <!-- <td><?php echo $convertedDate?></td>
                                <td><?php echo $gender?></td> -->
                                <td><?php echo $status?></td>
                                <td><?php echo $phone?></td>
                                <td><?php echo $type?></td>
                                <!-- <td><?php echo $photo?></td> -->
                                
                                <td>   
<<<<<<< HEAD
<<<<<<< HEAD
                                <a style="background-color:#1565C0FF ;" href="<?php echo  SITEURL; ?>showClientDetails.php?ClientId=<?php echo $id; ?>" class="btn btn-info">Show Details</a>
=======
                                <a  href="<?php echo  SITEURL; ?>showClientDetails.php?ClientId=<?php echo $id; ?>" class="btn btn-info">Show Details</a>
>>>>>>> c882d4c (init2)
                                    <a href="<?php echo  SITEURL; ?>updateClient.php?ClientId=<?php echo $id; ?>" class="btn btn-warning">Update</a> 
=======
                                <a  href="<?php echo  SITEURL; ?>showClientDetails.php?ClientId=<?php echo $id; ?>" class="btn btn-info">Show Details</a>

                                <a href="<?php echo  SITEURL; ?>updateClient.php?ClientId=<?php echo $id; ?>" class="btn btn-warning">Update</a> 
>>>>>>> ece5bf3 (deposite)
                                    <!-- <a href="<?php echo  SITEURL; ?>deleteServicePoint.php?ServicePointId=<?php echo $id; ?>" class="btn-danger">Delete Service Point</a>  -->
                                </td>
                              </tr>
                              <?php
                            }   

                          }
                          else{
                            //there is no data 
                            //display message 
                            ?>
                            <tr>
                              <td colspan="6"><div class="text-danger">No Client Added</div></td>
                            </tr>

                            <?php 
                          }
                      }
                  
                  
                  ?>

                 
               </table>
        </div>
</div>

<?php include('partials/footer.php') ?>