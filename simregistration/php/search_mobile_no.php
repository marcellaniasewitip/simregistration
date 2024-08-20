<?php
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
            echo "Full Name: " . $row['firstname'] . " " . $row['lastname'] . "\n";
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

    mysqli_close($conn);
}
?>
