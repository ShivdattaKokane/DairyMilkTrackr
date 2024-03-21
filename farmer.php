<?php
include 'snippets/head_footer.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/farmer.css">

    <title>farmer</title>
    <style media="screen">
        .main-container {
            margin-top: 80px;
        }
    </style>
</head>
<body>
<ul>
    <h2 class="h2">Customer Details</h2>
</ul>
<div class="main-container">
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><i class="fas fa-user-plus"></i> New farmer </button>
    <div id="id01" class="modal">
        <form class="modal-content animate" action="connect.php" method="POST">
            <h3><b><u>Add new farmer</u></b></h3>
            <div class="container">
                <label for="name">First Name <sup>*</sup> </label>
                <input type="text" name="firstname" value="" placeholder="enter name of farmer" required/>
                <br>
                <label for="ph">Phone number<sup>*</sup> </label>
                <input type="text" name="ph" value="" placeholder="Phone Number" maxlength="10" required/>
                <br>
                <label for="vid">Village id<sup>*</sup> </label>
                <input type="text" name="vid" value="" placeholder="Village" required/>
                <br>
                <label for="advanceSalary">Advance Salary</label>
                <input type="number" name="advanceSalary" placeholder="Enter advance salary amount" required/>
                <br>
                <label for="animalCount">Number of Animals<sup>*</sup> </label>
                <input type="number" name="animalCount" id="animalCount" min="0" placeholder="Enter the count of animal" required/>
                <br>

                <div id="animalFields"></div>

                <input type="submit" name="savedata" class="submit-btn-add" value="Submit">
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>

        <script>
            document.getElementById('animalCount').addEventListener('input', function () {
                generateAnimalFields(this.value);
            });

            function generateAnimalFields(count) {
                const animalFieldsContainer = document.getElementById('animalFields');
                animalFieldsContainer.innerHTML = ''; // Clear existing fields

                for (let i = 1; i <= count; i++) {
                    const animalIDLabel = document.createElement('label');
                    animalIDLabel.textContent = `Animal ${i} Health ID*`;
                    const animalIDInput = document.createElement('input');
                    animalIDInput.type = 'number';
                    animalIDInput.name = `animalID${i}`;
                    animalIDInput.placeholder = `Issued by Health Ministry`;
                    animalIDInput.maxLength = '12';

                    // Add dropdown for milk type
                    const milkTypeLabel = document.createElement('label');
                    milkTypeLabel.textContent = `Milk Type*`;
                    const milkTypeSelect = document.createElement('select');
                    milkTypeSelect.name = `milkType${i}`;
                    const optionCow = document.createElement('option');
                    optionCow.value = 'cow';
                    optionCow.textContent = 'Cow';
                    const optionBuffalo = document.createElement('option');
                    optionBuffalo.value = 'buffalo';
                    optionBuffalo.textContent = 'Buffalo';

                    milkTypeSelect.appendChild(optionCow);
                    milkTypeSelect.appendChild(optionBuffalo);

                    animalFieldsContainer.appendChild(animalIDLabel);
                    animalFieldsContainer.appendChild(animalIDInput);
                    animalFieldsContainer.appendChild(document.createElement('br'));
                    animalFieldsContainer.appendChild(milkTypeLabel);
                    animalFieldsContainer.appendChild(milkTypeSelect);
                    animalFieldsContainer.appendChild(document.createElement('br'));
                }
            }
        </script>

    </div>
    <!--################################################################################################################################################-->
    <!--Edit Modal-->

    <!--################################################################################################################################################-->
    <!--Delete Modal!-->

    <!--################################################################################################################################################-->
    <!--Fetch Details &  display-->
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
        $sql = "SELECT * FROM farmer ";
        $query_run = mysqli_query($conn, $sql);
        ?>

        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col"><i class="fas fa-id-badge"></i> ID</th>
                <th scope="col"><i class="fas fa-user-alt"></i> Firstname</th>
                <th scope="col"><i class="fas fa-phone"></i> Phone</th>
                <th scope="col"><i class="fas fa-address-book"></i> village Name</th>
                <th scope="col"><i class="fas fa-money-bill"></i> Remaining Salary</th> <!-- New column header -->
                <th scope="col"> <i class="fas fa-caret-square-down"></i> More</th>
            </tr>
            </thead>
            <?php
            if ($query_run) {
                foreach ($query_run as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['fname'] . '</td>';
                    echo '<td>' . $row['ph'] . '</td>';
                    echo '<td>' . $row['f_vid'] . '</td>';
                    echo '<td>' . $row['advanceSalary'] . '</td>'; // Display advance salary as remaining salary
                    echo '<td>';
                    echo '<div class="btn-group">';
                    echo '<a class="btn btn-secondary" href="edit.php?id=' . $row['id'] . '"><i class="fas fa-edit"></i> Edit</a>';
                    echo '<a class="btn btn-danger" onClick="javascript:return confirm(\'Do you really want to delete?\');" href="delete.php?id=' . $row['id'] . '"><i class="fas fa-trash-alt"></i> Delete</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo "No Record Found";
            }
            ?>
        </table>
    </div>
</div>
</div>
<hr>
<hr>
<div class="footer">
    <p>Copyright © 2023 Shivdatta <sub>All Rights Reserved</sub> </p>
</div>
<script src="css/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
