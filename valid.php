<?php
require_once 'connection.php';
session_start();

if (isset($_POST['senddata'])) {
    // Retrieve form data
    $fid = $_POST['fid'];
    $quan = $_POST['quan'];
    $fat = $_POST['fat'];
    $snf = $_POST['snf'];
    $rate_per_liter = $_POST['rate_per_liter'];
    $to_date = $_POST['to-date'];

    // Calculate total amount
    $total_amount = $quan * $rate_per_liter;

    // Deduct total amount from farmer's advance salary
    $sql = "SELECT advanceSalary FROM farmer WHERE id = $fid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $advanceSalary = $row['advanceSalary']; // Retrieve advanceSalary from the database

        // Deduct either the total amount or the remaining advance salary, whichever is less
        $advance_deduction =$advanceSalary- $total_amount;

        // Deduct advance salary from farmer's total
        $sql = "UPDATE farmer SET advanceSalary = $advanceSalary - $total_amount WHERE id = $fid";
        if ($conn->query($sql) !== TRUE) {
            echo "Error updating advance salary: " . $conn->error;
            exit(); // Exit script if query fails
        }
    } else {
        echo "Farmer ID not found";
        exit(); // Exit script if farmer ID is not found
    }

    // Insert record into the record table
    $sql = "INSERT INTO record (fid, quan, fat, snf, rate_per_liter, total_amount, advance_deduction) 
        VALUES ('$fid', '$quan', '$fat', '$snf', '$rate_per_liter', '$total_amount', '$advance_deduction')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error inserting record: " . $conn->error;
    } else {
        $_SESSION['status'] = '<script>alert("Data submitted successfully!");</script>';
        header("Location: data.php");
        exit();
    }
}
?>
