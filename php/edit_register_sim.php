<?php
include "../db_name.php";

// Initialize variables
$mobileno = "";
$firstname = "";
$lastname = "";
$province = "";
$gender = "";
$dob = "";
$address = "";

// Handle GET request to populate form with existing data
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location: edit_register_sim.php");
        exit;
    }

    $id = $_GET['id'];
    $updateDetails = "SELECT mobileno, firstname, lastname, province, gender, dob, address FROM registration WHERE id='$id'";
    $result = $conn->query($updateDetails);

    if ($result) {
        $row = $result->fetch_assoc();
        if (!$row) {
            header("location: view_registration.php");
            exit;
        }

        $mobileno = $row["mobileno"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $province = $row["province"];
        $gender = $row["gender"];
        $dob = $row["dob"];
        $address = $row["address"];
    } else {
        echo "Error fetching data: " . $conn->error;
    }
} 
// Handle POST request to update existing data
else {
    $id = $_POST["id"];
    $mobileno = $_POST["mobileno"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $province = $_POST["province"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];

    $updateLocation = "UPDATE registration SET mobileno='$mobileno', firstname='$firstname', lastname='$lastname', province='$province', gender='$gender', dob='$dob', address='$address' WHERE id='$id'";
    $sqlResult = $conn->query($updateLocation);

    if ($sqlResult === TRUE) {
        echo "<script type='text/javascript'>
            alert('Information Updated Successfully');
            window.location='view_registration.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Failed to update information: " . $conn->error . "');
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../css/register_sim.css">
</head>
<body>
    <section class="container">
        <div class="container-menu">
            <form method="POST" action="edit_register_sim.php" class="form" id="registrationForm">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
                <div class="main-user-info">
                    <div class="text-center">
                        <p class="text-muted">Edit Registration Information</p>
                    </div><br>
                    <div class="user-input-box">
                        <label for="mobileno">Mobile Number</label>
                        <input type="text" name="mobileno" required value="<?php echo $mobileno; ?>"/> 
                    </div>
                    <div class="user-input-box">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" required value="<?php echo $firstname; ?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" required value="<?php echo $lastname; ?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="province">Province</label>
                        <input type="text" name="province" required value="<?php echo $province; ?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" required value="<?php echo $dob; ?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="address">Address</label>
                        <input type="text" name="address" required value="<?php echo $address; ?>"/>
                    </div>
                    <div class="user-input-box">
                        <label for="gender">Gender:</label>
                        <select name="gender" class="form-control">
                            <option value="male" <?php if ($gender == "male") echo "selected"; ?>>Male</option>
                            <option value="female" <?php if ($gender == "female") echo "selected"; ?>>Female</option>
                        </select>
                    </div><br><br>
                    <div class="form-submit-btn">
                        <button type="submit" class="btn btn-success" name="submit">Update</button>
                        <a href="./dashboard.php"><button type="button" class="btn btn-success">Exit</button></a><br><br>
                    </div> 
                </div>   
            </form>
        </div>
    </section>
    
<footer class="main-footer">
    <strong><a href="#">© Simple Mobile Number (SIM) Registration Portal Demonstration</a></strong>
    <div class="float-right d-none d-sm-inline-block"></div>
</footer>
</body>
</html>
