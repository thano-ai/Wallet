<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Cleint Details</h1>
               <br> <br>
<<<<<<< HEAD

               <!-- button to add admin -->
               <!-- <a href="<?php echo  SITEURL; ?>addServicePoint.php" class="btn-primary">Add Service Point</a> -->
               <!-- <br> <br> <br> -->

=======
               
>>>>>>> c882d4c (init2)
               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Name</th>
                      <th>Birthdate</th>
                      <th>Gender</th>
                      <th>Status</th>
                      <th>Phone</th>
                      <th>Type</th>
                      <th>Photo</th>
                      
                  </tr>

                  <?php
                      // display from database
<<<<<<< HEAD
                      $sql = "SELECT * from clients" ;
=======
                      $id = $_GET['ClientId'] ;
                      $sql = "SELECT * from clients
                      WHERE ClientId =$id" ;
>>>>>>> c882d4c (init2)
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
                              $bithdate = $rows['birthDate'] ;
                              $gender = $rows['gender'] ;
                              $status = $rows['status'] ;
                              $phone = $rows['phone'] ;
                              $type = $rows['type'] ;
                              $photo = $rows['photo'] ;
                              
                              
                              $convertedDate = $bithdate->format('Y-m-d ');

                              // display in the table 
                              ?>

                              <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $firstname , $lastname ?></td>
                                <td><?php echo $convertedDate?></td>
                                <td><?php echo $gender?></td>
                                <td><?php echo $status?></td>
                                <td><?php echo $phone?></td>
                                <td><?php echo $type?></td>
                                <td><?php echo $photo?></td>
                                
                                
                              </tr>
                              <?php
                            }   

                          }
                          else{
                            //there is no data 
                            //display message 
                            ?>
                            <tr>
                              <td colspan="6"><div class="text-danger">not found</div></td>
                            </tr>

                            <?php 
                          }
                      }
                  
                  
                  ?>

                 
               </table>
                    <a href="<?php echo  SITEURL; ?>manageCleints.php" class="btn btn-secondary">Go Back</a>

        </div>
</div>

<?php include('partials/footer.php') ?>