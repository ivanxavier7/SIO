<?php
$connection = mysqli_connect('localhost', 'root', 'password', 'dblogin');
if (!$connection) {
    echo "Connection to the database failed!";
}
?>