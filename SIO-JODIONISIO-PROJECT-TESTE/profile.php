<?php include "header.php";?>     
        <p class="h4">Another Secure Profile Page</p>
        <form action="" class="form-inline">
        <input type="text" id="book_search" class="form-control rounded" placeholder="Procurar por livros...">
        <!--<input type="button" id="book_search_button" name="book_search_button"/>-->
        <a type="button" name="book_search_button" id="book_search_button" class="btn btn-primary" href="#" role="button">Search</a>
        </form>
        
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
            $connection = mysqli_connect('localhost', 'root', '', 'dblogin');
            $query = "select * from books where id in (select book from user_books where user = " .  $userRow['user_id']  . ");";
            $result = mysqli_query($connection, $query);
            
            if(!$result) {
              die('Query FAILED' . mysqli_error($connection, $query));
            }



            if ($result->num_rows > 0) {
              print_r($userRow['user_id']);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td> ";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "<td>" . "<input type=submit value='Editar' name='$row[0]'>" . "</td>";
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

<?php include "footer.php";?>