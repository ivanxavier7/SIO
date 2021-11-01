<?php

//require __DIR__.'dbconfig.php';

//$conn = dbConnection();

include "db.php";

global $connection;

$user_id = $_POST['user_id'];
$livro = $_POST['search'];

//$servername = "localhost";
//$username = "root";
//$password = ""; //you can put password into it if your mysq server has a password
//$dbname = "dblogin";
//
//$conn = new mysqli($servername, $username, $password, $dbname);
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}

$sql = "select * from books where id = $livro and user_id = $user_id ;";
$result = mysqli_query($connection, $sql);;


if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
//        echo print_r($row);
        echo "<tr>";
        echo "<td>" . $row[0] . "</td>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[3] . "</td>";
        echo "<td>" . $row[4] . "</td>";
        echo "</tr>";
    }
}

echo "Procurou por: " . $livro;

//else {
//    echo "0 results" . $user_id . $livro;
//}
$connection->close();
?>