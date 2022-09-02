<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Manage Cleints</h1>
               <br> <br>
               <?php


if(isset($_SESSION['update'])){
  echo '<script type="text/javascript">
  swal("", "Client Updated Successfully", "success");
  </script>';
    unset($_SESSION['update']) ; //display just one time 
 }

 if(isset($_SESSION['not-update'])){
  echo '<script type="text/javascript">
swal("", "Failed to Update Client", "error");
</script>';
  unset($_SESSION['not-update']) ; //display just one time 
}
               if(isset($_SESSION['add'])){
                echo '<script type="text/javascript">
                swal("", "Client Added Successfully", "success");
                </script>';
                  unset($_SESSION['add']) ; //display just one time 
               }

               if(isset($_SESSION['not-add'])){
                echo '<script type="text/javascript">
						swal("", "Failed to Add Client", "error");
						</script>'; 
                unset($_SESSION['not-add']) ; //display just one time 
             }
             if(isset($_SESSION['exist'])){
              echo '<script type="text/javascript">
          swal("", "Client already exist", "error");
          </script>'; 
              unset($_SESSION['exist']) ; //display just one time 
           }

               ?>
               <!-- button to add admin -->
               <a style="background-color:#278abd ;" href="<?php echo  SITEURL; ?>addClient.php" class="btn btn-primary">Add Client</a>
               <br> <br> 
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
                                <a  href="<?php echo  SITEURL; ?>showClientDetails.php?ClientId=<?php echo $id; ?>" class="btn btn-info">Show Details</a>

                                <a href="<?php echo  SITEURL; ?>updateClient.php?ClientId=<?php echo $id; ?>"  class="btn btn-warning">Update</a> 
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