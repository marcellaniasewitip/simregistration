<?php
include "../db_name.php";

if (isset($_POST['submit'])) {
    $mobileno = $_POST['mobileno'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $province= $_POST['province'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

 // Check if mobile number already exists
 $checkMobile = "SELECT mobileno FROM registration WHERE mobileno = ?";
 $stmtCheck = mysqli_prepare($conn, $checkMobile);


 if ($stmtCheck) {
    mysqli_stmt_bind_param($stmtCheck, "s", $mobileno);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        // Mobile number already exists
        echo ("<script language='javascript' type='text/javascript'>
        alert('Mobile number already exists, please enter a different number.');
        window.location='register_sim.php';
        </script>");
    } else {

    $addUser = "INSERT INTO `registration`(`mobileno`, `firstname`, `lastname`,  `province`,`gender`, `dob`, `address`) 
                   VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $addUser);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $mobileno, $firstname, $lastname, $province, $gender, $dob, $address);

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            //header("Location: index.php?msg=New record created successfully");
            // Redirect the dashboard user to the dashboard panel
                echo ("<script language='javascript' type='text/javascript'>
                alert('Information Saved Successfully');
               window.location='dashboard.php';
                </script>");
        } else {
           // echo "Failed: " . mysqli_error($conn);
            echo ("<script language='javascript' type='text/javascript'>
            alert('Please try again');
           window.location='register_sim.php';
            </script>");
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the statement.";
    }
}
}
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">-->
    <link rel="stylesheet" href="../css/register_sim.css">
</head>
<body>
    <section class="container">
        <div class="container-menu">
            <form method="POST" action="register_sim.php" class="form" id="registrationForm">
                <div class="main-user-info">
                    <div class="text-center">
                        <p class="text-muted">Fill Registration Information</p>
                    </div><br>
                    <div class="user-input-box">
                        <label for="mobileno">Mobile Number</label>
                        <input type="number" name="mobileno" required/>
                    </div>
                    <div class="user-input-box">
                        <label for="firstname">FirstName</label>
                        <input type="text" name="firstname" required/>
                    </div>
                    <div class="user-input-box">
                        <label for="lastname">LastName</label>
                        <input type="text" name="lastname" required/>
                    </div>
                    <div class="user-input-box">
                        <label for="province">Province</label>
                        <input type="text" name="province" required/>
                    </div>
                    <div class="user-input-box">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" required/>
                    </div>
                    <div class="user-input-box">
                        <label for="address">Address</label>
                        <input type="text" name="address" required/>
                    </div>
                    <div class="user-input-box">
                        <label for="gender">Gender:</label>
                        <select name="gender" class="form-control">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div><br><br>
                    <div class="form-submit-btn">
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                        <a href="./dashboard.php"><button type="button" class="btn btn-success">Exit</button></a><br><br>
                    </div> 
                </div>   
            </form>
        </div>
    </section>
    
<footer class="main-footer">
    <strong><a href="">© Simple Mobile Number (SIM) Registration Portal Demonstration
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
</body>
</html>
