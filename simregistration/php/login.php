<?php
// Start a session
session_start();

// Include the database connection file
include_once '../db_name.php';

// Retrieve the values from the login form and store them in variables
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_POST['username'];
$password = $_POST['password'];

 
    $agentSQL = "SELECT * FROM agent WHERE username = '" . $username . "' AND password = '" . $password . "'";

    $agentDetails = mysqli_query($conn, $agentSQL);


    if (mysqli_num_rows($agentDetails) > 0) {
        $row = mysqli_fetch_assoc($agentDetails);
        $username = $row['username'];
        $_SESSION["username"] = $username;

        echo ("<script language='javascript' type='text/javascript'>
        alert('User Login Successful');
        window.location='dashboard.php';
        </script>");
    } else {
        echo ("<script language='javascript' type='text/javascript'>
        alert('Enter Correct Credential');
        window.location='login.php';
        </script>");
    }
}

// Close the database connection
mysqli_close($conn);
/*$conn->close();*/
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="../css/login.css">
    <script src="https://kit.fontawesome.com/f9176182d0.js" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

 </head>
<body>
    
    <div class="container">
    <div class="form-box">
    <h3>Log In</h3><br>
    <form action="login.php" method="POST" >
        <div class="input-group">

            
            <div class="input-field">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-field">                
            <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="password" required>
            </div><br><br><br><br>

                    <div class="form-submit-btn"><br>
                        <button type="submit" class="btn btn-success" name="submit">Login</button>
                        <a href="../index.php"><button type="button" class="btn btn-danger">Exit</button></a>
                    </div> 

            </div><br><br>
                <p>I don't have an Account?<a href="signup.php">SignUp Here</a></p>

        </div><br><br>
</form>
 </div>
</div>


<footer class="main-footer">
    <strong><a href="">© Simple Mobile Number (SIM) Registration Portal Demonstration
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
    
</body>
</html>