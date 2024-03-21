<?php
$servername = "localhost";
$port = "3307"; 
$username = "root";
$password = "Shivdatta@123";
$dbname = "dry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['savedata'])) {
    $firstname = $_POST['firstname'];
    $ph = $_POST['ph'];
    $vid = $_POST['vid'];
    $min_litre = $_POST['animalCount'];
    $advanceSalary = $_POST['advanceSalary'];

    // Assuming you have an array to store the milk types
    $milk_types = array();

    for ($i = 1; $i <= $min_litre; $i++) {
        // Update the line where you're trying to retrieve the milk type from $_POST
        $milk_types[$i] = isset($_POST["milkType$i"]) ? $_POST["milkType$i"] : '';
    }

    // Insert into the farmer table
    $sql = "INSERT INTO farmer (fname, ph, f_vid, advanceSalary, animalCount)
            VALUES ('$firstname','$ph','$vid','$advanceSalary', '$min_litre')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit; // Exit the script if there's an error
    }

    // Fetch the last inserted farmer_id
    $farmer_id = $conn->insert_id;

    // Assuming you have an 'animal' table to store animal information
    for ($i = 1; $i <= $min_litre; $i++) {
        $animalID = $_POST["animalID$i"];
        $healthID = isset($_POST["healthID$i"]) ? $_POST["healthID$i"] : ''; // Provide a default value if not set
        $milk_type = isset($milk_types[$i]) ? $milk_types[$i] : ''; // Retrieve from the array

        // Check if the farmer_id exists in the farmer table
        $check_farmer_sql = "SELECT id FROM farmer WHERE id = $farmer_id";
        $check_farmer_result = $conn->query($check_farmer_sql);

        if ($check_farmer_result->num_rows == 0) {
            echo "Error: Farmer with ID $farmer_id does not exist.";
            exit; // Exit the script if the farmer ID does not exist
        }

        // Insert into the animal table
        $sql = "INSERT INTO animal (animalID, healthID, milk_type, min_litre, reg_date, farmer_id)
                VALUES ('$animalID', '$healthID', '$milk_type', '$min_litre', NOW(), '$farmer_id')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit; // Exit the script if there's an error
        }
    }
    header("Location: farmer.php");
    exit;
}

$conn->close();
?>
