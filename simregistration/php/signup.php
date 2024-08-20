<?php
// Start a session
session_start();

include "../db_name.php";

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username already exists
    $checkUsername = "SELECT username FROM agent WHERE username = ?";
    $stmtCheck = mysqli_prepare($conn, $checkUsername);

    if ($stmtCheck) {
        mysqli_stmt_bind_param($stmtCheck, "s", $username);
        mysqli_stmt_execute($stmtCheck);
        mysqli_stmt_store_result($stmtCheck);

        if (mysqli_stmt_num_rows($stmtCheck) > 0) {
            // Username already exists
            echo ("<script language='javascript' type='text/javascript'>
            alert('Username already exists, please choose another one');
            window.location='signup.php';
            </script>");
        } else {
            $addAgent = "INSERT INTO `agent`(`fullname`, `username`, `password`) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $addAgent);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $fullname, $username, $password);

                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    //header("Location: index.php?msg=New record created successfully");
                    // Redirect the agent back to the index page
                    echo ("<script language='javascript' type='text/javascript'>
                    alert('Successfully Added');
                    window.location='../index.php';
                    </script>");
                } else {
                    // echo "Failed: " . mysqli_error($conn);
                    echo ("<script language='javascript' type='text/javascript'>
                    alert('Registration was unsuccessful');
                    window.location='signup.php';
                    </script>");
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Failed to prepare the statement.";
            }
        }
    } else {
        echo "Failed to prepare the statement.";
    }

    mysqli_stmt_close($stmtCheck);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>

    <link rel="stylesheet" href="../css/signup.css">
    <script src="https://kit.fontawesome.com/f9176182d0.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    
    <div class="container">
    <div class="form-box">
    <h3>Sign Up</h3><br>
    <form action="signup.php" method="POST" >
        <div class="input-group">

            <div class="input-field">                
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                <input type="text" name="fullname" placeholder="Fullname" required>
            </div>

            <div class="input-field">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="password" required>
            </div>
           
            <div class="form-submit-btn">
               <button type="submit" class="btn btn-success" name="submit">Sign Up</button>
            </div> 

            </div><br>
                <p>I have an Account?<a href="login.php">Login Here</a></p>

        </div><br>
        </div>
</form>
 </div>
</div>
    

<footer class="main-footer">
    <strong><a href="">© Simple Mobile Number (SIM) Registration Portal Demonstration
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>

</body>

<script>
document.querySelector('form').addEventListener('submit', function(event) {
    let isValid = true;
    const inputs = document.querySelectorAll('input[required]');
    inputs.forEach(input => {
        if (!input.value) {
            isValid = false;
            input.style.border = '2px solid red';
        } else {
            input.style.border = 'none';
        }
    });
    if (!isValid) {
        event.preventDefault();
        alert('Please fill in all required fields.');
    }
});
</script>
</html>