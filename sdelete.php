<!-- <?php

// require_once 'connection.php';  //connecting to database


// //###########################
// //This deletion is for staff id
// if (isset($_GET['eid'])) {
//     $id = $_GET['eid']; // get id through query string
// }
// $del = "DELETE FROM `employee` WHERE eid='$id'"; // delete query

// if ($conn->query($del) === TRUE) {

//   header('Location: staff.php');
//   //echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();
?> -->
<?php

require_once 'connection.php';  //connecting to the database

// This deletion is for staff id
if (isset($_GET['eid'])) {
    $id = $_GET['eid']; // get id through query string

    // Check if there are associated records in milk_center
    $check_associated_records_sql = "SELECT COUNT(*) as record_count FROM milk_center WHERE staff_id = $id";
    $result = $conn->query($check_associated_records_sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        $recordCount = $row['record_count'];

        // Only delete the employee if there are no associated records
        if ($recordCount == 0) {
            $del = "DELETE FROM `employee` WHERE eid='$id'"; // delete query

            if ($conn->query($del) === TRUE) {
                header('Location: staff.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('Cannot delete employee. Associated records found in milk_center table.');</script>";;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

