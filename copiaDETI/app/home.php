<?php include "header.php"; ?>
<?php include "db.php"; ?>
<?php include "functions.php"; ?>

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
//                $connection = mysqli_connect('localhost', 'root', 'password', 'dblogin');
                global $connection;
                $query = "select * from books;";
                $result = mysqli_query($connection, $query);

                if (!$result) {
                        die('Query FAILED' . mysqli_error($connection, $query));
                }



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
                ?>
                <script>

                </script>

        </tbody>
</table>
<div class="alert alert-info">
            <?php getData() ?>
</div>
<?php include "footer.php"; ?>