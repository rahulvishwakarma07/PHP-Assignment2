<?php
echo "Connecting to System MySQL database<br>";

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'phpuser';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn) {
    echo "Connected to System MySQL Successfully <br>";
} else {
    echo "System MySQL connection failed: " . mysqli_connect_error();
}

$tablesql = 'CREATE TABLE IF NOT EXISTS user (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(100),
    Email VARCHAR(200) UNIQUE KEY NOT NULL,
    Password VARCHAR(200) NOT NULL
)';

$result = mysqli_query($conn, $tablesql);
if ($result) {
    echo "Table created successfully <br>";
} else {
    echo "Something went wrong" . mysqli_connect_errno();
}

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
} else {
    $username = '';
    $email = '';
    $password = '';
}

$hashedPassword = password_hash($password , PASSWORD_DEFAULT);

$insertSql = "INSERT INTO user (Username, Email, Password) VALUES ('$username', '$email', '$hashedPassword')";
$insertResult = mysqli_query($conn, $insertSql);

if ($insertResult) {
    echo "SignUp successfully";
} else {
    echo "Something went wrong";
}
?>
