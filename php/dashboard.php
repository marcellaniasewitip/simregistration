
<?php

//Include the database configuration file for database connection
include "../db_name.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$searchQuery = $_POST['searchQuery'];
$query = "SELECT * FROM `registration` WHERE `mobileno` = ?";

$stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
    
        mysqli_stmt_bind_param($stmt, "s", $searchQuery);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "Mobile Number: " . $row['mobileno'] . "\n";
            echo "Name: " . $row['firstname'] . " " . $row['lastname'] . "\n";
            echo "Province: " . $row['province'] . "\n";
            echo "Gender: " . $row['gender'] . "\n";
            echo "Date of Birth: " . $row['dob'] . "\n";
            echo "Address: " . $row['address'] . "\n";
        } else {
            echo "Number not available.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the statement.";
    }
// Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="container">
        <div class="container dashboard"><br>
            <h3 class="text-center">SIM REGISTRATION</h3>
            <form id="searchForm" class="mt-4 d-flex">
                <input type="number" class="form-control me-2" id="searchQuery" name="searchQuery" placeholder="Search mobile numbers">
                <button type="submit" class="btn btn-success">Search</button>
            </form><br><br><br>

            <div class="d-grid">
                <button class="btn btn-primary" onclick="registerSim()">Register SIM</button><br>
                <a href="view_registration.php" class="btn btn-secondary">View Registration</a>
            </div><br><br><br>

           <br><a href="logout.php" class="btn btn-danger mb-4">Logout</a>
        </div>
    </div>
    
    <script>
        function registerSim() {
            window.location.href = 'register_sim.php';
        }

        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const searchQuery = document.getElementById('searchQuery').value;

            fetch('search_mobile_no.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'searchQuery=' + encodeURIComponent(searchQuery)
            })
            .then(response => response.text())
            .then(data => alert(data))
            .catch(error => console.error('Error:', error));
        });
    </script>

    
<footer class="main-footer">
    <strong>© Simple Mobile Number (SIM) Registration Portal Demonstration
    <div class="float-right d-none d-sm-inline-block">     
    </div>
  </footer>
</body>
</html>
