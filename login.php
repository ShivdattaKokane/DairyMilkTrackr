<?php 
// $servername = "localhost";
// $port = "3307"; 
// $username = "root";
// $password = "Shivdatta@123";
// $dbname = "dry";

//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $dbname,$port);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// if (isset($_POST['data'])) {
//   $loginname  =  $_POST['uname'];
// $loginpassword    =  $_POST['psw'];
// }

    
//     $query=mysqli_query($conn,"select * from employee where eid='".$loginname."'AND phno='".$loginpassword."' limit 1");
// 	$rows=mysqli_num_rows($query);
    
//     if($rows == 1){
//         echo " You Have Entered correct Password";
// 	   header("Location:startpage.php");
//     }
//     else{
//         echo " You Have Entered Incorrect Password";
//         exit();
//     }
?>

<?php
$servername = "localhost";
// $port = "3307";
// $username = "root";
// $password = "Shivdatta@123";
// $dbname = "dry";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname, $port);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// if (isset($_POST['data'])) {
//     $loginname = $_POST['uname'];
//     $loginpassword = $_POST['psw'];
// }

// $query = mysqli_query($conn, "SELECT * FROM employee WHERE eid='$loginname' LIMIT 1");

// if ($query) {
//     $employee = mysqli_fetch_assoc($query);

//     if ($employee) {
//         // Assuming passwords are stored as plain text
//         if ($loginpassword == $employee['phno']) {
//             echo "You Have Entered correct Password";
//             header("Location: startpage.php");
//             exit();
//         } else {
//             echo "You Have Entered Incorrect Password";
//             exit();
//         }
//     } else {
//         echo "User not found";
//         exit();
//     }
// } else {
//     echo "Query failed: " . mysqli_error($conn);
//     exit();
// }
// if (isset($_POST['data'])) {
//   $loginname = $_POST['uname'];
//   $loginpassword = $_POST['psw'];

//   // Use prepared statements to prevent SQL injection
//   $stmt = $conn->prepare("SELECT * FROM employee WHERE eid=? AND phno=? LIMIT 1");
//   $stmt->bind_param("ss", $loginname, $loginpassword);
//   $stmt->execute();
//   $result = $stmt->get_result();

//   if ($result->num_rows == 1) {
//       echo "You have entered the correct password";
//       header("Location: startpage.php");
//       exit();
//   } else {
//       echo "You have entered an  password";
//   }

//   $stmt->close();
// }
?>

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

if (isset($_POST['data'])) {
    $loginname = $_POST['uname'];
    $loginpassword = $_POST['psw'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM login WHERE uname=? AND pass=? LIMIT 1");
    $stmt->bind_param("ss", $loginname, $loginpassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Authentication successful
        session_start();
        $_SESSION['user_id'] = $loginname; // Store user ID or relevant information in the session
        header("Location: startpage.php");
        exit();
    } else {
        // Authentication failed
        echo "<script>alert('Incorrect username or password.');</script>";
        
        header("Location: loginpage.html");
        exit();
    }

    $stmt->close();
}
?>

