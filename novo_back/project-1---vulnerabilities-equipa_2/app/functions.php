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
    if(isset($_POST['submit2'])) {
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

function getData() {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://quotes15.p.rapidapi.com/quotes/random/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: quotes15.p.rapidapi.com",
            "x-rapidapi-key: abe68b4fc2msh8bcb97df87601f8p1d20d9jsn4e6e2de4b64e"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $response = json_decode($response, true);
        echo "<b>Phrase of the day</b><br>" . $response['content'] . "<br><p> <b>Author: </b>" . $response['originator']['name'];
    }
}

function loadCookies() {
    $expiration = time() + (60 * 60 * 24 * 7) ; // (Tempo desde 1970-01-01 em segundos + (segundos * minutos * horas * dias)) = semanas
    if(!empty($_POST["remember"])) {
        echo $_POST["txt_uname_email"] . $_POST["txt_password"] . "TESTE";
        setcookie ("username",$_POST["txt_uname_email"],$expiration);
        setcookie ("password",password_hash($_POST["txt_password"], PASSWORD_DEFAULT),$expiration);
        echo "Cookies Set Successfuly!";
    } else {
        setcookie("username","");
        setcookie("password","");
        echo "Cookies Not Set!";
    }
}

?>
