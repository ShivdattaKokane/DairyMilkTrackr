<?php
include 'snippets/head_footer.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Animal Info</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style media="screen">
    .main-content{
      margin-top: 120px;
    }
    h2{
      color: black;
    }
  </style>
</head>
<body>

  <div class="main-content">

    <h2> <img src="images/cow-silhouette.png" alt="cow" style="height:50px; width:auto;"> Dairy Animal Details</h2>

    <!-- Fetch Details -->
    <div class="card">
      <div class="card-body">
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

        // Fetch all animal information along with farmer details
        $sql = "SELECT a.farmer_id,a.animalID, a.healthID, a.milk_type, a.min_litre, a.reg_date, f.fname, f.ph
                FROM animal a
                JOIN farmer f ON a.farmer_id = f.id";
        $query_run = mysqli_query($conn, $sql);
        ?>

        <table id="example1" class="table table-striped table-hover">
          <thead>
            <tr>
            <th scope="col"><img src="images/dorsal.png" alt="" style="height:25px; width:auto;"> Farmer ID</th>
              <th scope="col"><img src="images/dorsal.png" alt="" style="height:25px; width:auto;">  Animal Health ID</th>
              <th scope="col"><i class="fas fa-user-alt"></i>  Owner</th>
              <th scope="col"><i class="fas fa-phone">  Phone</th>
              <th scope="col"><img src="images/cow-silhouette.png" alt="" style="height:25px; width:auto;">  Animal Type</th>
              
              <th scope="col"><i class="fas fa-calendar-alt"></i>  Registerd Date</th>
            </tr>
          </thead>

          <tbody> <!-- Move tbody outside the loop -->
            <?php
            if ($query_run) {
              while ($row = mysqli_fetch_assoc($query_run)) { // Fetch each row as an associative array
                ?>
                <tr>
                <td> <?php echo $row['farmer_id']; ?> </td>
                  <td> <?php echo $row['animalID']; ?> </td>
                  <td> <?php echo $row['fname']; ?> </td>
                  <td> <?php echo $row['ph']; ?> </td>
                  <td> <?php echo $row['milk_type']; ?> </td>
                  
                  <td> <?php echo $row['reg_date']; ?> </td>
                </tr>
                <?php
              }
            } else {
              echo "No Record Found";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#example1').DataTable();
    });
  </script>

</body>
</html>
