<?php include('partials/menu.php') ?>

<div class="container">
        <div class="wrapper">
               <h1>Manage Currencies</h1>
               <br> <br>
               <?php
 
 if(isset($_SESSION['update'])){
  echo '<script type="text/javascript">
  swal("", "Currency Updated Successfully", "success");
  </script>';
    unset($_SESSION['update']) ; //display just one time 
 }

 if(isset($_SESSION['not-update'])){
  echo '<script type="text/javascript">
swal("", "Failed to Update Currency", "error");
</script>';
  unset($_SESSION['not-update']) ; //display just one time 
}

               ?>
               <br>

               <table class="table table-hover">
                  <tr class="table-active">
                      <th>ID</th>
                      <th>Currency Type</th>
                      <th>Selling Price</th>
                      <th>Buying Price</th>
                      <th>Date</th>

                      <th>Process</th>
                      
                  </tr>

                  <?php
                      // display from database
                      $sql = "SELECT * from currencies" ;
                      $res = sqlsrv_query($con,$sql) ;

                      if($res==true){
                            $count = sqlsrv_has_rows($res) ;
                          $sn=1;
                          if($count>0){
                            // we have data in db
                            while($rows = sqlsrv_fetch_array($res)){
                              // get the data 
                              $id = $rows['id'] ; 
                              $currencyType = $rows['currencyType'] ;
                              $sellingPrice = $rows['sellingPrice'] ;
                              $buyingPrice = $rows['buyingPrice'] ;
                              $creationDate = $rows['creationDate'] ;
                              
                              
                              
                              $convertedDate = $creationDate->format('Y-m-d ');

                              // display in the table 
                              ?>

                              <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $currencyType?></td>
                                <td><?php echo $sellingPrice?></td>
                                <td><?php echo $buyingPrice?></td>
                                <td><?php echo $convertedDate?></td>
                                
                                
                                <td>   
                                <!-- <a href="<?php echo  SITEURL; ?>showClientDetails.php?ClientId=<?php echo $id; ?>" class="btn-primary">Show Client Details</a> -->
                                    <a href="<?php echo  SITEURL; ?>updateCurrency.php?id=<?php echo $id; ?>" class="btn btn-warning">Update</a> 
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
                              <td colspan="6"><div class="text-danger">No Currencies Added</div></td>
                            </tr>

                            <?php 
                          }

                        }
                  
                  
                  ?>

                 
               </table>
        </div>
</div>

<?php include('partials/footer.php') ?>