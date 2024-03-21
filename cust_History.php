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

// Check if farmer_id is provided
if(isset($_GET['farmer_id'])) {
    $farmer_id = $_GET['farmer_id'];

    // Fetch purchase history based on farmer_id
    $sql = "SELECT id, customer_name, customer_mobile, Total_cost, Bhusa, Golipend, Saraki_pend, Sengdana_pend, buying_date
            FROM Dairy_customers
            WHERE farmer_id = $farmer_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered border-success">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col"><i class="fas fa-file-invoice-dollar"></i> Invoice ID</th>';
        echo '<th scope="col"><i class="fas fa-user-alt"></i> Name</th>';
        echo '<th scope="col"><i class="fas fa-phone"> Mobile</th>';
        echo '<th scope="col"><i class="fas fa-rupee-sign"></i> Total Cost</th>';
        echo '<th scope="col" colspan="4"><i class="fab fa-product-hunt"></i> Products Purchased</th>'; // Change colspan to 4
        echo '<th scope="col">Purchasing Date</th>'; // New column for purchasing date
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
                              
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["customer_name"] . '</td>';
            echo '<td>' . $row["customer_mobile"] . '</td>';
            echo '<td><i class="fas fa-rupee-sign"></i> ' . $row["Total_cost"] . '</td>';
            // Modify this part to include product quantities
            
            echo '<td>Bhusa: ' . $row["Bhusa"] . ' Goni</td><br>';
            echo '<td>Golipend: ' . $row["Golipend"] . ' Goni</td><br>';
            echo '<td>Saraki_pend: ' . $row["Saraki_pend"] . ' Goni</td><br>';
            echo '<td>Sengdana_pend: ' . $row["Sengdana_pend"] . ' Goni</td><br>';
            
            // Display the purchasing date in a new column
            echo '<td>' . $row["buying_date"] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "0 results";
    }
} else {
    echo "Farmer ID not provided";
}

$conn->close();
?>
