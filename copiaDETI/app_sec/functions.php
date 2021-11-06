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

function BdConnect(){
    try {
        $pdo = new PDO("mysql:host=localhost; dbname=dblogin", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
    return $pdo;
}


function AddBook() {
    global $userRow;
    if(isset($_POST['submit'])) {
        $connection = BdConnect();
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $author = htmlspecialchars($_POST['author'], ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');
        $id_user = htmlspecialchars($userRow['user_id'], ENT_QUOTES, 'UTF-8');

        $query = "INSERT INTO books(name, author, price, user_id) ";
        $query .= "VALUES (?, ?, ?, ?);";
        $result = $connection->prepare($query);
        $result->execute(array($name, $author, $price, $id_user));
        
        if(!$result) {
            die('Query FAILED');
        } else {
            echo '<div class="alert alert-success" role="alert">'
            . 'Successfully Added!'
            . '</div>';
        }    
    }
}

function EditBook() {
    if(isset($_POST['submit2'])) {
        $connection = BdConnect();
        $id_book = htmlspecialchars($_POST['id_book'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($_POST['name_book'], ENT_QUOTES, 'UTF-8');
        $author = htmlspecialchars($_POST['author_book'], ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($_POST['price_book'], ENT_QUOTES, 'UTF-8');

        $query = "UPDATE books SET";
        $query .= " name= ?, author= ?, price= ? WHERE id= ?";
        $result = $connection->prepare($query);
        $result->execute(array($name, $author, $price, $id_book));   
        
        if(!$result) {
            die('Query FAILED');
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

?>
