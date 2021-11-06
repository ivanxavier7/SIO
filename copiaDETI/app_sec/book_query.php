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
include "functions.php";

try{
    
    $connection = BdConnect();

    $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES, 'UTF-8');
    $livro = htmlspecialchars($_POST['search'], ENT_QUOTES, 'UTF-8');
    $query = "SELECT id, name, author, price FROM books WHERE id = ? AND user_id = ? ;";
    $result = $connection->prepare($query);
    $result->execute(array($livro, $user_id));

    while ($row = $result->fetch(PDO::FETCH_BOTH)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') . "</td> ";
        echo "<td>" . htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "</tr>";
    }
    
    echo "Procurou por: " . $livro;
}catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
//else {
//    echo "0 results" . $user_id . $livro;
//}
