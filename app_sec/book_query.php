<?php

//require __DIR__.'dbconfig.php';

//$conn = dbConnection();


/* at the top of 'check.php' */
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    /*
       Up to you which header to send, some prefer 404 even if
       the files does exist for security
    */
    header('HTTP/1.0 403 Forbidden', TRUE, 403);

    /* choose the appropriate page to redirect users */
    die(header('location: /error.php'));

}


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

echo "Procurou por: " . htmlspecialchars($livro, ENT_QUOTES, 'UTF-8');

//else {
//    echo "0 results" . $user_id . $livro;
//}
$connection->close();
?>