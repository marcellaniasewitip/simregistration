
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
     <!--Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
     integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
     crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="../css/view_registration.css">


    <title>Registered SIM</title>
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #f00b0b; color:white;">
SIM Registration Information
</nav>  

<div class="container">
    <?php
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">
        '.$msg.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
  <a href="./dashboard.php" class="btn btn-dark mb-3">Back</a>
 
  <table class="table table-hover text-center background-color: #0a923e; color: #f00b0b;">
  <thead  style="background-color: #f00b0b; color:white;">
    <tr>
     
      <th scope="col">Registered SIM Number</th>
      <th scope="col">First Name</th>
      <th scope="col">LastName</th>
      <th scope="col">Province</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">Gender</th>    
      <th scope="col">Address</th>  
     <!--
      <th scope="col">Edit</th>  
      <th scope="col">Delete</th> 
  -->   
    </tr>

  </thead>  
  <tbody> 
    <?php
    include "../db_name.php";

    $registeredSIM = "SELECT * FROM `registration`";
    $result = mysqli_query($conn, $registeredSIM);
    while ($row = mysqli_fetch_assoc($result)){
     ?>
       <tr> 
    <td><?php echo $row['mobileno']?></td>
    <td><?php echo $row['firstname']?></td>
    <td><?php echo $row['lastname']?></td>
    <td><?php echo $row['province']?></td>
    <td><?php echo $row['dob']?></td>
    <td><?php echo $row['gender']?></td>    
    <td><?php echo $row['address']?></td>

   <!-- <td>
        <a href="./edit_register_sim.php?id=<?php echo $row['id']?>" class="btn btn-info"><i class="fa-solid fa-pen-to-square fs-5 me-7"></i></a>
    </td>
    <td>
    <a href="./delete_registration.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
        <i class="fa-solid fa-trash fs-5"></i>
    </a>
</td>-->


    </tr> 
    <?php
    
    }
    ?>
    
  </tbody>
</table>

</div>

<footer class="main-footer">
    <strong><a href="">© Simple Vodafone Number (SIM) Registration Portal Demonstration
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
  
</body>

</html>