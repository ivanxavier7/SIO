<?php

//require __DIR__.'dbconfig.php';

//$conn = dbConnection();

$user_id = $_GET["user_id"];
$livro = $_GET["search"];
$servername = "localhost";
$username = "root";
$password = ""; //you can put password into it if your mysq server has a password
$dbname = "dblogin";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from books where id in (select book from user_books where user = " . $user_id . ") and id = " . $livro .";";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row[0] . "</td>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[3] . "</td>";
        echo "</tr>";
//        echo "<script> console.log(" . $row . "); </script>";
    }
}
//else {
//    echo "0 results" . $user_id . $livro;
//}
$conn->close();
?>