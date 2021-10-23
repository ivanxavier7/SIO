<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--===============================================================================================-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>welcome - <?php print($userRow['user_email']); ?></title>
</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://www.ua.pt/" target="_blank">UA</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://sweet.ua.pt/jpbarraca/course/sio-2021/main/" target="_blank">SIO</a></li>
            <li><a href="https://cwe.mitre.org/data/definitions/79.html" target="_blank">CWE-79</a></li>
            <li ><a href="https://cwe.mitre.org/data/definitions/89.html" target="_blank">CWE-89</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div class="clearfix"></div>
	
    <div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<label class="h5">welcome : <?php print($userRow['user_name']); ?></label>
        <hr />
        
        <h1>
        <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp; 
        <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a></h1>
        <hr />
        
        <p class="h4">Another Secure Profile Page</p>

        <input type="text" id="book_search" placeholder="Procurar por livros...">
        <input type="button" id="book_search_button" name="book_search_button"/>
        <script>
            let btn = document.getElementById("book_search_button");
            btn.addEventListener("click", function (){
                // console.log("aqui");
                let text_field = document.getElementById("book_search");
                let params = 'search=' + text_field.value + '&user_id=' + '<?php print($userRow['user_id']); ?>' ;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', "./book_query.php?" + params);
                xhr.onload = function () {
                    // console.log(this.response);
                    document.getElementById("books_tbody").innerHTML = this.response;
                };
                // console.log("aqui?");
                xhr.send();
            });

        </script>

        <table class="table" id="tab_livros">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Livro</th>
                <th scope="col">Autor</th>
                <th scope="col">Preço</th>
            </tr>
            </thead>
            <tbody id="books_tbody">

            <?php

            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "dblogin";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "select * from books where id in (select book from user_books where user = " .  $userRow['user_id']  . ");";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td> ";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "</tr>";
//                    echo "<script> console.log(" . $row . "); </script>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
            <script>

            </script>

            </tbody>
        </table>
        
        <p class="blockquote-reverse" style="margin-top:200px;">
    Aveiro University - SIO 2021 - Safe Web page<br /><br />
    <a href="#">secure system is one that is not insecure!</a>
    </p>
    
    </div>

</div>



</body>
</html>