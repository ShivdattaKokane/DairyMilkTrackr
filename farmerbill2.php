<?php
require_once "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Add any additional CSS styles here -->
    <style media="screen"> 
   
    .table th, .table td {
        white-space: nowrap; /* Prevent wrapping of content */
    }

    @media print {
        .table {
            width: 100% !important; /* Ensure table expands to full width when printing */
            margin-bottom: 1rem !important; /* Adjust margin for printing */
        }
        body {
            background-image: url('Gholap Dudh Dairy-logos_black.png'); /* Path to your watermark image */
            background-repeat: no-repeat;
            background-position: center; /* Position the watermark at the center */
            background-size: contain; /* Adjust the size of the watermark */
        }
    }

    .header {
        position: fixed;
        right: 0;
        top: 0;
        width: 100%;
        background-color: black;
        color: white;
        text-align: center;
    }

    .LOGO {
        height: 100px;
        width: auto;
        float: left;
        margin-left: 30px;
    }

    .list {
        float: right;
        margin-right: 40px;
    }

    .list li {
        display: inline-block;
        margin-right: 30px;
        margin-top: 30px;
    }

    .list li a {
        text-decoration: none;
        font-size: 20px;
        color: white;
        font-family: serif;
        font-weight: bold;
    }

    .list li:hover {
        border-bottom: 4px solid yellow;
        transition: .3s;
    }

    /* Additional styles for container */
    /* .container {
        margin-top: 150px; /* Adjust this value as needed */
     */
    
    .delete-icon {
      position: absolute;
      padding: 4px 5px;
      border-radius: 5px;
      text-decoration: none;
      margin-left: 50px;
    }

    .delete-icon:hover {
      transform: scale(1.2);
      opacity: 0.8;
    }
    u{
      text-decoration: none;
    }
    .print-button {
        padding: 10px 20px;
        background-color: #4CAF50; /* Green */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .print-button:hover {
        background-color: #45a049; /* Darker green */
    }

    .watermark {
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-70deg);
        opacity: 0.3; /* Adjust the opacity as needed */
        font-size: 4em; /* Adjust the font size as needed */
        color: #a52a; /* Adjust the color as needed */
        pointer-events: none; /* Ensure the watermark doesn't interfere with mouse events */
    }



    
    </style>
</head>
<body>
    

    <div class="container">
    <a class="delete-icon" href="farmer.php"><i class="fas fa-arrow-circle-left"></i></a>
        <?php
        if(isset($_GET['fid']) && isset($_GET['from-date']) && isset($_GET['to-date'])) {
            $fid = $_GET['fid'];
            $frmdate = date("Y-m-d", strtotime($_GET['from-date']));
            $todate = date("Y-m-d", strtotime($_GET['to-date']));
            echo "Farmer ID: " . $fid . "<br>";
            echo "From Date: " . $frmdate . "<br>";
            echo "To Date: " . $todate . "<br>";
            $sql = "SELECT fname, advanceSalary FROM farmer WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $fid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h2>Receipt for " . $row['fname'] . "</h2>";
                echo "<h3>Transactions:</h3>";
                echo "<h4>Remaining Salary: " . $row['advanceSalary'] . "</h4>";
            } else {
                echo "<h2>Farmer not found with the specified ID.</h2>";
            }

            $stmt->close();
        } else {
            echo "<h2>Invalid request. Please provide all required parameters.</h2>";
        }
        ?>

        <!-- Display transaction table -->
        <?php
        if(isset($_GET['fid']) && isset($_GET['from-date']) && isset($_GET['to-date'])) {
            $fid = $_GET['fid'];
            $frmdate = date("Y-m-d", strtotime($_GET['from-date']));
            $todate = date("Y-m-d", strtotime($_GET['to-date']));
            $sql = "SELECT 
            r.id AS record_id,
            r.fid AS farmer_id,
            r.quan AS quantity_liters,
            r.fat,
            r.snf,
            r.rate_per_liter,
            r.dt AS record_date,
            r.total_amount,
            r.advance_deduction,
            IFNULL(dc.customer_name, '') AS customer_name,
            IFNULL(dc.customer_mobile, '') AS customer_mobile,
            IFNULL(dc.Total_cost, 0) AS total_cost,
            IFNULL(dc.Bhusa, 0) AS Bhusa,
            IFNULL(dc.Golipend, 0) AS Golipend,
            IFNULL(dc.Saraki_pend, 0) AS Saraki_pend,
            IFNULL(dc.Sengdana_pend, 0) AS Sengdana_pend,
            IFNULL(dc.buying_date, '') AS buying_date
        FROM 
            record r
        LEFT JOIN 
            dairy_customers dc ON r.fid = dc.farmer_id AND r.dt = dc.buying_date
        WHERE 
            r.fid = ? 
            AND r.dt BETWEEN ? AND ?
        ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $fid, $frmdate, $todate);

$stmt->execute();
$result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<div class='design'>";
                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr>";

                echo "<th>Farmer ID</th>";
                echo "<th>Date</th>";
                echo "<th>Quantity (Liters)</th>";
                echo "<th>Fat</th>";
                echo "<th>SNF</th>";
                echo "<th>Rate Per Liter</th>";
                
                echo "<th>Total Amount (&#8377;)</th>";
                echo "<th>Advance Deduction (&#8377;)</th>";
                
                echo "<th>Total Cost</th>";
                echo "<th>Bhusa</th>";
                echo "<th>Golipend</th>";
                echo "<th>Saraki Pend</th>";
                echo "<th>Sengdana Pend</th>";
               
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                
                    echo "<td>" . (isset($row['farmer_id']) ? $row['farmer_id'] : '') . "</td>";
                    echo "<td>" . (isset($row['record_date']) ? $row['record_date'] : '') . "</td>";
                    echo "<td>" . (isset($row['quantity_liters']) ? $row['quantity_liters'] : '') . "</td>";
                    echo "<td>" . (isset($row['fat']) ? $row['fat'] : '') . "</td>";
                    echo "<td>" . (isset($row['snf']) ? $row['snf'] : '') . "</td>";
                    echo "<td>" . (isset($row['rate_per_liter']) ? $row['rate_per_liter'] : '') . "</td>";
                    
                    echo "<td>" . (isset($row['total_amount']) ? $row['total_amount'] : '') . "</td>";
                    echo "<td>" . (isset($row['advance_deduction']) ? $row['advance_deduction'] : '') . "</td>";
                    
                    echo "<td>" . (isset($row['total_cost']) ? $row['total_cost'] : '') . "</td>";
                    echo "<td>" . (isset($row['Bhusa']) ? $row['Bhusa'] : '') . "</td>";
                    echo "<td>" . (isset($row['Golipend']) ? $row['Golipend'] : '') . "</td>";
                    echo "<td>" . (isset($row['Saraki_pend']) ? $row['Saraki_pend'] : '') . "</td>";
                    echo "<td>" . (isset($row['Sengdana_pend']) ? $row['Sengdana_pend'] : '') . "</td>";

                
                    echo "</tr>";
                }
                

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<h3>No records found for the specified farmer ID and date range.</h3>";
            }

            $stmt->close();
        }
        ?>
    </div>
    <div class="watermark">Gholap Dudh Dairy</div>
        <div class="button-container">
            <button class="print-button" onclick="window.print()">Print Receipt</button>
        </div>
</body>
</html>
