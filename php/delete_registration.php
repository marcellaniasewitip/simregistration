<?php
include "../db_name.php";

$id = $_GET['id'];

if (isset($id) && !empty($id)) {
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0");

    // Delete the record from the registration table based on their respective id
    $deleteRegistration = "DELETE FROM registration WHERE id = '$id'";

    $resultDelete = mysqli_query($conn, $deleteRegistration);

    if ($resultDelete) {
        echo ("<script language='javascript' type='text/javascript'>
                    alert('Record deleted successfully');
                    window.location='view_registration.php';
                    </script>");
    } else {
        echo "Failed to delete record: " . mysqli_error($conn);
    }
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1");
} else {
    echo "id not provided or invalid.";
}
?>
