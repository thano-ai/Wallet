<?php
include('config/constants.php') ;



?>



<html>
    <head>
        <title>YCB .Local</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="CSS/bootswachTheme.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        <!-- <link rel="stylesheet" href="CSS/admin-style.css"> -->
    </head>
    <body>
        <!-- menu section starts -->
        <nav style="background-color:#278abd ;" class="navbar navbar-expand-lg navbar-dark " >
  <div   class="container-fluid">
    <a class="navbar-brand" href="#"><span class="navbar-toggler-icon"></span>YCB .Local</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home
            <span class="visually-hidden">(current)</span>
          </a>
        </li>

        <?php

if(isset($_SESSION['super'])){

  echo ' <li class="nav-item">
  <a class="nav-link" href="manageAdmins.php">Admins</a>
</li>';
}

?>
       
        <li class="nav-item">
          <a class="nav-link" href="manageServicePoint.php">Service Points</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manageAccounts.php">Accounts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manageCleints.php">Cleints</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manageTransactions.php">Transactions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manageCommissions.php">Commissions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manageCurrencies.php">Currencies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">Reports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Logout</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li> -->
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>

<?php

if(!isset($_SESSION['admin_id'])){
  header("Location:".SITEURL."login.php");

}

?>
    