<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'phpuser';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);

if ($result) {
    $html = '<table border="1"><tr><th>Sr.</th><th>Username</th><th>Email</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $html .= "<tr>
            <td>{$row['Id']}</td>
            <td>{$row['Username']}</td>
            <td>{$row['Email']}</td>
        </tr>";
    }

    $html .= '</table>';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="report.xls"');
    echo $html;
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
