<?php
include 'snippets/head_footer.php';
require_once 'connection.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Entry</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .main-box {
            width: auto;
            margin-top: 130px;
        }

        .heading {
            top: 12%;
            color: black;
            font-size: 35px;
            text-align: center;
            position: relative;
            letter-spacing: 3px;
            line-height: 10px;
        }

        .entry {
            font-size: 23px;
            margin: 30px;
            line-height: 20px;
        }

        .entry input {
            padding: 7px;
        }

        .container {
            width: 100%;
            clear: both;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }

        .form-control-sm {
            height: calc(1.5em + 0.5rem + 2px);
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
            width: calc(100% - 10px); /* Adjust the width as needed */
        }

        .submit-btn-add {
            margin-left: 150px;
        }
    </style>
</head>
<body>
<div class="main-box container">
    <h3 class="heading">Daily Data Entry Sheet</h3>
    <form class="entry" action="valid.php" method="POST">
        <div class="row">
            <div class="col-md-6">
                <label for="fid">Farmer id:</label>
                <input type="text" class="form-control" id="fid" name="fid" placeholder="Enter farmer id">
            </div>
            <div class="col-md-6">
                <label for="quan">Quantity:</label>
                <input type="text" class="form-control" id="quan" name="quan" placeholder="Enter quantity">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="fat">Fat:</label>
                <input type="text" class="form-control" id="fat" name="fat" placeholder="Enter fat content">
            </div>
            <div class="col-md-6">
                <label for="snf">SNF:</label>
                <input type="text" class="form-control" id="snf" name="snf" placeholder="Enter SNF content">
            </div>
        </div>
        <div class="row">
			<div class="col-md-6">
                <label for="rate_per_liter">Rate/lit:</label>
                <input type="text" class="form-control" id="rate_per_liter" name="rate_per_liter" placeholder="Enter rate per liter">
            </div>
            
            
        </div>
        <br>
        <input type="submit" name="senddata" class="btn btn-add" value="Submit">
    </form>
</div>
</body>
</html>


