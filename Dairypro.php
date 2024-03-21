<?php
$servername = "localhost";
$username = "root";
$password = "Shivdatta@123";
$dbname = "dry";
$port = "3307";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['save_the_form_data'])) {
  // Retrieve input values
  $farmer_id = $_POST['farmer_id'];

  // Fetch farmer details from the database using prepared statement
  $fetch_farmer_query = "SELECT fname, ph AS mobile, advanceSalary FROM farmer WHERE id = ?";
  $stmt = $conn->prepare($fetch_farmer_query);
  $stmt->bind_param("i", $farmer_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['fname'];
    $mobile = $row['mobile'];
    $advance_salary = $row['advanceSalary'];

    // Retrieve input values
    $quantity_bhusa = $_POST['quantity1'];
    $quantity_golipend = $_POST['quantity2'];
    $quantity_saraki_pend = $_POST['quantity3'];
    $quantity_sengdana_pend = $_POST['quantity4'];

    // Calculate total cost
    $total_cost = $quantity_bhusa * 500 + $quantity_golipend * 1300 + $quantity_saraki_pend * 1200 + $quantity_sengdana_pend * 2000;

    // Update advance salary
    $updated_advance_salary = $advance_salary + $total_cost;
    $update_salary_query = "UPDATE farmer SET advanceSalary = ? WHERE id = ?";
    $stmt = $conn->prepare($update_salary_query);
    $stmt->bind_param("ii", $updated_advance_salary, $farmer_id);
    if ($stmt->execute()) {
      // Insert order details into Dairy_customers table
      $current_date = date("Y-m-d");
      $insert_query = "INSERT INTO Dairy_customers (customer_name, customer_mobile, farmer_id, Total_cost, Bhusa, Golipend, Saraki_pend, Sengdana_pend, buying_date)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($insert_query);
      $stmt->bind_param("siiiiiiss", $name, $mobile, $farmer_id, $total_cost, $quantity_bhusa, $quantity_golipend, $quantity_saraki_pend, $quantity_sengdana_pend, $current_date);
      if ($stmt->execute()) {
        // Redirect to the desired page after successful submission
        header('Location: Cart.php');
        exit;
      } else {
        echo "Error inserting order details: " . $conn->error;
      }
    } else {
      echo "Error updating advance salary: " . $conn->error;
    }
  } else {
    echo "No farmer found with ID: $farmer_id";
  }
}

$conn->close();
?>
