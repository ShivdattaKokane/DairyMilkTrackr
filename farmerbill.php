
<?php require_once "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Generation</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Add any additional CSS styles here -->
	<style>
/* Header styling */
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

.main-box {
    width: auto;
    margin-top: 90px;
}

.heading {
    top: 12%;
    color: white;
    font-size: 35px;
    text-align: center;
    position: relative;
    letter-spacing: 3px;
    line-height: 10px;
}

.bill label {
    padding: 10px;
    margin-top: 10px;
    font-size: 25px;
    font-weight: bold;
    font-family: cursive;
    line-height: 40px;
    color: black;
}

.bill input {
    background-color: rgba(255, 255, 255, 0);
    font-size: 20px;
    line-height: 20px;
    padding: 10px;
    margin-top: 25px;
    font-weight: bold;
    color: black; /* Added to ensure placeholder color is black */
}

.design {
    width: 100%;
    text-align: center;
}

.bill input:hover {
    background-color: rgba(255, 255, 255, 0.5);
}

.submit {
    font-size: 15px;
    line-height: 20px;
    padding: 10px;
    margin-top: 25px;
}

#receipt label {
    font-size: 30px;
    font-family: ui-sans-serif;
    font-weight: bold;
    color: black;
}

#receipt input {
    font-size: 20px;
    text-align: center;
    padding: 10px;
    margin-top: 25px;
    font-weight: bold;
    width: 150px;
    border: none;
    margin-left: 10px;
    background-color: rgba(255, 255, 255, 0);
}

.bdy {
    background-image:  url('images/bill.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
}

.submitf {
    color: red;
    font-size: 20px;
    margin-left: 500px;
}

/* Added to style placeholder text */
input[type="date"]::-webkit-input-placeholder {
    color: black;
}

input[type="date"]:-moz-placeholder {
    color: black;
}

input[type="date"]::-moz-placeholder {
    color: black;
}

input[type="date"]:-ms-input-placeholder {
    color: black;
}
    </style>
</head>
<body>
    <div class="header">
        <a href="startpage.php"><img src="images/NATURE-ONE-DAIRY-CORPORATE-LOGO-01.png" alt="logo" class="LOGO"></a>
        <ul class="list">
            <li><a href="startpage.php" class="effect">HOME</a></li>
            <li><a href="Service.php" class="effect">SERVICE</a></li>
            <li><a href="aboutus.html" class="effect">ABOUT US</a></li>
        </ul>
        <h3 class="heading">Bill Generation</h3>
    </div>

    <div class="main-box">
        <form class="bill" action="farmerbill2.php" method="GET">
            <label for="fid">Farmer ID:</label>
            <input type="text" name="fid" value="" placeholder="Enter farmer id"/>

            <label>From-Date:</label>
            <input type="date" name="from-date"/>

            <label>To-Date:</label>
            <input type="date" name="to-date"/>

            <br>
            <input type="submit" class="btn btn-success submitf" name="billinfo" value="Submit"/>
            <hr>
        </form>
    </div>
</body>
</html>

