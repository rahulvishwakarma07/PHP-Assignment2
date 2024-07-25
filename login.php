<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'phpuser';

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (isset($_POST['email']) && isset($_POST['pswd'])) {
        $email = $_POST['email'];
        $password = $_POST['pswd'];
    } else {
        $email = '';
        $password = '';
    }

    $loginSql = "SELECT * FROM user WHERE Email = '$email'";
    $loginResult = mysqli_query($conn, $loginSql);

    if ($loginResult) {
        $user = mysqli_fetch_assoc($loginResult);

        // Verify the password
        if (password_verify($password, $user['Password'])) {
            // Fetch all users
            $userListSql = "SELECT * FROM user";
            $userListResult = mysqli_query($conn, $userListSql);

            if ($userListResult) {
                echo '<div class="container mt-4">';
                echo '<h2 class="fw-bold text-danger text-center">User List</h2>';
                echo '<table class="mt-3 table table-bordered table-striped">';
                echo '<thead class="thead-dark">
            <tr class="table-dark">
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            </tr>
            </thead>';
                echo '<tbody>';
                while ($row = mysqli_fetch_assoc($userListResult)) {
                    echo "<tr>
                <td>{$row['Id']}</td>
                <td>{$row['Username']}</td>
                <td>{$row['Email']}</td>
                </tr>";
                }
                echo '</tbody>';
                echo '</table>';
                echo '<a href="export.php"><button type="submit" class="btn btn-danger mt-3 mb-3">Export to Excel</button></a>';
                echo '</div>';
            } else {
                echo "Error retrieving user list.";
            }
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }

    mysqli_close($conn);
    ?>

</body>

</html>