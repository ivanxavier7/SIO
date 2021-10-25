<?php
$connection = mysqli_connect('localhost', 'root', '', 'dblogin');
if (!$connection) {
    echo "Connection to the database failed!";
}
?>