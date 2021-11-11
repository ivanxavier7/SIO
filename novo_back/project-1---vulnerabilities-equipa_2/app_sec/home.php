<?php include "header.php"; ?>
<?php include "db.php"; ?>
<?php include "functions.php"; ?>

<table class="table" id="tab_livros">
        <thead>
                <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book</th>
                        <th scope="col">Author</th>
                        <th scope="col">Price (€)</th>
                </tr>
        </thead>
        <tbody id="books_tbody">

                <?php
                try {
                        $connection = BdConnect();
                        $query = "SELECT id, name, author, price FROM books;";
                        $result = $connection->prepare($query);
                        $result->execute();

                        while ($row = $result->fetch(PDO::FETCH_BOTH)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td>" . htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') . "</td> ";
                                echo "<td>" . htmlspecialchars($row[2], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "<td>" . htmlspecialchars($row[3], ENT_QUOTES, 'UTF-8') . "</td>";
                                echo "</tr>";
                        }
                } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                }
                ?>
        </tbody>
</table>
<div class="alert alert-info">
        <?php getData() ?>
</div>

<div class="alert alert-info center-block" style="width: 40%;" role="alert">
        <label class="h4"><b>Session Data</b> <p>Username: <?php print($userRow['user_name']); ?></p></label>
</div>
<div class="alert alert-danger center-block" style="width: 40%;" role="alert">       
        <?php
        if(isset($_COOKIE['username'])){
                echo "<b>Cookie Data</b><p>Username: ";
                $username = $_COOKIE['username'];
                echo "" . $username . "</p>";
        }   else {
                $username = "You can save your cookies with the switch on the login page </p>";
        }
        if(isset($_COOKIE['password'])){
                echo "<p>Password Encriptada na Cookie: ";
                $password = $_COOKIE['password'];
                echo "" . $password . "</p>";
        }   else {
                $password = "";
        }
        if(isset($_COOKIE['password'])){
                echo "<p>Password Desencriptada: ";
                $passwordDec = decryptString($_COOKIE['password']);
        echo "" . $passwordDec ;
        }   else {
                $passwordDec = "";
        }
        ?></p>
</div>
<?php include "footer.php"; ?>