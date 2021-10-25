<?php include "db.php";?>
<?php

function showAllData() {
    global $connection;
    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        echo "<option value='$id'>$id</option>";
    }
}

function UpdateTable(){
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];


    $query = "UPDATE users SET ";
    $query .= "username = '$username', ";
    $query .="password = '$password' ";
    $query .="WHERE id = '$id' ";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("QUERY FAILED!" .mysqli_error($connection));
    }
}

function DeleteRow(){
    global $connection;
    $id = $_POST['id'];


    $query = "DELETE FROM users ";
    $query .="WHERE id = '$id' ";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("QUERY FAILED!" .mysqli_error($connection));
    }
}

function AddBook() {
    global $connection;
    global $userRow;
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $id_user = $userRow['user_id'];

        $query = "INSERT INTO books(name, author, price, user_id) ";
        $query .= "VALUES ('$name', '$author', '$price', '$id_user')";
        $result = mysqli_query($connection, $query);
/*
        echo "TESTE - " . $userRow['user_id'];
        $query2 = "INSERT INTO user_books(user, book) ";
        $query2 .= "VALUES ('" . $userRow['user_id'] . "', '1')";
        $result = mysqli_query($connection, $query2);
*/        
        
        
        if(!$result) {
            die('Query FAILED' . mysqli_error($connection, $query));
        } else {
            echo '<div class="alert alert-success" role="alert">'
            . 'Successfully Added!'
            . '</div>';
        }
    }
}

function EditBook() {
    global $connection;
    if(isset($_POST['submit'])) {
        $id = $_POST['id_book'];
        $name = $_POST['name_book'];
        $author = $_POST['author_book'];
        $price = $_POST['price_book'];
        //echo $id_book, $name_book, $author_book, $price_book;
        $query = "UPDATE books SET";
        $query .= " name='$name', author='$author', price='$price' WHERE id = '$id'";
        $result = mysqli_query($connection, $query);   
        
        if(!$result) {
            die('Query FAILED' . mysqli_error($connection, $query));
        } else {
            echo '<div class="alert alert-success" role="alert">'
            . 'Successfully Edited!'
            . '</div>';
        }
        
    }
}

?>
