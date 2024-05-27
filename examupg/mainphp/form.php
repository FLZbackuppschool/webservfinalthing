<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .error-message {
            color: red;
            display: none;
        }
    </style>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary" style="background-color: #;">
        <div class="container-fluid">
            <a class="navbar-brand" href="Form.php">Form input</a>
            <button data-mdb-collapse-init class="navbar-toggler" type="button"data-mdb-target="#navbarNav" aria-controls="navbarNav"aria-expanded="false"aria-label="Toggle navigation">
             <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="form.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="tabledata.php">Table of the data</a>
                </li>
            </div>
        </div>
    </nav>
</header>
<body>

<form id="userForm" action="tabledata.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">  
            <div data-mdb-input-init class="form-outline">
                <label class="form-label" for="form8Example1">Name</label>
                <input type="text" name="user_name" id="form8Example1" class="form-control" placeholder="Enter your name" required/>
                <div class="error-message" id="name">Please enter your name.</div>
            </div>
        </div>
        <div class="col">
            <label class="form-label" for="form8Example2">Email address</label>
            <div data-mdb-input-init class="form-outline">
                <input type="email" name="user_email" id="form8Example2" class="form-control" placeholder="Enter your email address" required/>
                <div class="error-message" id="email">Please enter a valid email address.</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">  
            <div data-mdb-input-init class="form-outline">
                <label class="form-label" for="form8Example3">Last name</label>
                <input type="text" name="user_surname" id="form8Example3" class="form-control" placeholder="Enter your last name" required/>
                <div class="error-message" id="lastName">Please enter your last name.</div>
            </div>
        </div>
        <div class="col">  
            <div data-mdb-input-init class="form-outline">
                <label class="form-label" for="form8Example4">Bank balance</label>
                <input type="text" name="user_bank_balance" id="form8Example4" class="form-control" placeholder="Enter your bank balance" required/>
                <div class="error-message" id="bankBalance">Please enter your bank balance.</div>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="file" class="form-control" name="picture" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
        <div class="error-message" id="file">Please upload a file.</div>
    </div>
    <hr/>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
<?php //OBS previus code mixed with new one 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_bank";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Extract form data
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_surname = $_POST['user_surname'];
    $user_bank_balance = $_POST['user_bank_balance'];


    if(isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        if ($_FILES["picture"]["size"] > 20000000) {
            die("Your file is too big.");
        }// Check for errors during the  time that file is getting  upload  and Check if the file size is within the limit (less than 20MB)
        $fileExt = explode(".", $_FILES["picture"]["name"]);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array("jpg", "jpeg", "png", "gif");
        if (!in_array($fileActualExt, $allowed)) {
            die("You cannot upload files of this type.");
        }
        // Move uploaded file to target directory
        if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            die("There was an error uploading your file.");
        }
        
        // Set picture path and showes where its located
        $picture_path = $target_file;
    } else {
        die("No file uploaded or an error occurred with the file upload.");
    }

    // Prepare SQL statement for inserting data into the database
    $sql = "INSERT INTO user_info (user_name, user_email, user_surname, user_bank_balance, picture) 
            VALUES ('$user_name', '$user_email', '$user_surname', '$user_bank_balance', '$picture_path')";

    // Execute SQL statement and see if it has been created 
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
