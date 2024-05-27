<?php
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

// Fetch data from the database
$sql = "SELECT user_bank_name, user_name, user_surname, user_bank_number, user_email, picture FROM user_info";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Information</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4">User Information</h2>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>User Bank Name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Bank Number</th>
                <th>Email</th>
                <th>Picture</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['user_bank_name'] . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['user_surname'] . "</td>";
                echo "<td>" . $row['user_bank_number'] . "</td>";
                echo "<td>" . $row['user_email'] . "</td>";
                echo "<td><img src='" . $row['picture'] . "' width='100'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
