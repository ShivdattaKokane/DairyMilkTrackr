<?php
require_once 'connection.php';  //connecting to the database

// This deletion is for farmer id
if (isset($_GET['id'])) {
    $id = $_GET['id']; // get id through the query string

    // Delete all records from the 'dairy_customers' table where the farmer ID matches
    $delDairyCustomers = "DELETE FROM `dairy_customers` WHERE farmer_id='$id'";
    if ($conn->query($delDairyCustomers) === TRUE) {
        // Now delete all records from the 'record' table where the farmer ID matches
        $delRecords = "DELETE FROM `record` WHERE fid='$id'";
        if ($conn->query($delRecords) === TRUE) {
            // Now delete all records from the 'animal' table where the farmer ID matches
            $delAnimals = "DELETE FROM `animal` WHERE farmer_id='$id'";
            if ($conn->query($delAnimals) === TRUE) {
                // Now delete the farmer record
                $delFarmer = "DELETE FROM `farmer` WHERE id='$id'";
                if ($conn->query($delFarmer) === TRUE) {
                    header('Location: farmer.php');
                } else {
                    echo "Error deleting farmer record: " . $conn->error;
                    // handle the error, if necessary
                }
            } else {
                echo "Error deleting animals associated with the farmer: " . $conn->error;
                // handle the error, if necessary
            }
        } else {
            echo "Error deleting records associated with the farmer: " . $conn->error;
            // handle the error, if necessary
        }
    } else {
        echo "Error deleting dairy customers associated with the farmer: " . $conn->error;
        // handle the error, if necessary
    }
}

$conn->close();
?>
