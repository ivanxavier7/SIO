<?php include "db.php";?>

<?php

function showAllData() {
    global $connection;
    $query = "SELECT * FROM users";
    if (RateLimiter(30, 4)) {
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            echo "<option value='$id'>$id</option>";
        }
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
    if (RateLimiter(30, 4)) {
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("QUERY FAILED!" .mysqli_error($connection));
        }
    }
}

function DeleteRow(){
    global $connection;
    $id = $_POST['id'];
    $query = "DELETE FROM users ";
    $query .="WHERE id = '$id' ";
    if (RateLimiter(30, 4)) {
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("QUERY FAILED!" .mysqli_error($connection));
        }
    }
}

function BdConnect(){
    try {
        $pdo = new PDO("mysql:host=localhost; dbname=dblogin", 'root', 'password');
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
        if (RateLimiter(30, 4)) {
            $result = $connection->prepare($query);
            $result->execute(array($name, $author, $price, $id_user));
            if (!$result) {
                die('Query FAILED');
            } else {
                echo '<div class="alert alert-success" role="alert">'
            . 'Successfully Added!'
            . '</div>';
            }
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
        if (RateLimiter(30, 4)) {
            $result = $connection->prepare($query);
            $result->execute(array($name, $author, $price, $id_book));
            if (!$result) {
                die('Query FAILED');
            } else {
                echo '<div class="alert alert-success" role="alert">'
            . 'Successfully Edited!'
            . '</div>';
            }
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
    if(RateLimiter(30,4)) {
        $response = curl_exec($curl);
        //else $response = "";
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            echo "<b>Phrase of the day</b><br>" . $response['content'] . "<br><p> <b>Author: </b>" . $response['originator']['name'];
        }
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

function encryptString($string) { 
    $ciphering = "AES-128-CTR";
    //$iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '8437158652544936';
    $encryption_key = "ChaveParaEncriptar";
    $encryption = openssl_encrypt($string, $ciphering,
                $encryption_key, $options, $encryption_iv);
    //echo "Encrypted String: " . $encryption . "\n";  
    return $encryption;
}

function decryptString($string) { 
    $ciphering = "AES-128-CTR";
    //$iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0; 
    $decryption_iv = '8437158652544936';
    $decryption_key = "ChaveParaEncriptar"; 
    $decryption=openssl_decrypt ($string, $ciphering, 
            $decryption_key, $options, $decryption_iv);
    //echo "Decrypted String: " . $decryption;
    return $decryption;    
    }

function RateLimiter($delay, $reqLimit) {
    $redisClient = new Predis\Client();
    if($_SERVER['REQUEST_METHOD']=='GET') {
        // Identificar o cliente por IP
        $ip = $_SERVER['REMOTE_ADDR'];
        // Procura o IP na base de dados e se existir incrementa no contador
        $reqCount = $redisClient->incr($ip);
        // Se for a primeira vez, guarda o IP a expirar em 20 segundos
        if($reqCount == 1) $redisClient->expire($ip, $delay);
        if($reqCount < $reqLimit) {
            return true;
        } else {
            // Devolve o TTL que aquele IP têm para expirar, time to live
            $ttl = $redisClient->ttl($ip);
            echo ("To many requests. Try again after {$ttl} seconds.");
        }
    }
}

?>
