<?php
$connection = mysqli_connect('mysql', 'test', 'test', 'dblogin');
if (!$connection) {
    echo "Connection to the database failed!";
}
?>