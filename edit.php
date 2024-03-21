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

$id = $_GET['id'];

$showquery = "SELECT * FROM farmer WHERE id=$id";

$showdata = mysqli_query($conn, $showquery);

$arrdata = mysqli_fetch_array($showdata);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Update</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/farmer.css">
    <style media="screen">
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

    </style>
</head>
<body>
    <form class="modal-content animate" action="" method="POST">
        <h3><b><u>Update Customer Details</u></b> <a class="delete-icon" href="farmer.php"><i class="fas fa-arrow-circle-left"></i></a></h3>
        <div class="container">
            <label for="fname">First Name <sup>*</sup> </label>
            <input type="text" name="fname" value="<?php echo $arrdata['fname']; ?>" placeholder="first name" required/>
            <br>
            <label for="ph">Phone number<sup>*</sup> </label>
            <input type="text" name="ph" value="<?php echo $arrdata['ph']; ?>" placeholder="Phone Number" maxlength="10" required/>
            <br>
            <label for="f_vid">Village ID<sup>*</sup> </label>
            <input type="text" name="f_vid" value="<?php echo $arrdata['f_vid']; ?>" placeholder="Village ID" required/>
            <br>
            <label for="advanceSalary">Advance Salary</label>
            <input type="number" name="advanceSalary" value="<?php echo $arrdata['advanceSalary']; ?>" placeholder="Enter advance salary amount" required/>
            <br>
            <label for="animalCount">Number of Animals<sup>*</sup> </label>
            <input type="number" id="animalCount" name="animalCount" value="<?php echo $arrdata['animalCount']; ?>" placeholder="Enter the count of animal" required onchange="generateAnimalFields()">
            <br>
            <!-- Container for animal fields -->
            <div id="animalFields"></div>
            <br>
            <input type="submit" name="updatefarmerdata" class="submit-btn-add" value="Update">
            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Hidden field to store farmer ID -->
        </div>
    </form>

    <script>
        function generateAnimalFields() {
            const animalCount = document.getElementById('animalCount').value;
            const animalFieldsContainer = document.getElementById('animalFields');
            animalFieldsContainer.innerHTML = ''; // Clear existing fields

            for (let i = 1; i <= animalCount; i++) {
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

        // Call the function initially to generate fields if count is already set
        generateAnimalFields();
    </script>
</body>
</html>
