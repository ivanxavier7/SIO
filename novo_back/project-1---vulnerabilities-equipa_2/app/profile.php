<?php include "header.php";?>
<?php include "db.php";?>


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
                xhr.open('POST', "./book_query.php?", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    // console.log(this.response);
                    document.getElementById("books_tbody").innerHTML = this.response;
                };
                // console.log("aqui?");
                xhr.send(params);
            });

        </script>

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
//            $connection = mysqli_connect('localhost', 'root', '', 'dblogin');
            global $connection;
            $query = "select * from books where user_id in (select user_id from users where user_id = " .  $userRow['user_id']  . ");";
            $result = mysqli_query($connection, $query);
            
            if(!$result) {
              die('Query FAILED' . mysqli_error($connection, $query));
            }



            if ($result->num_rows > 0) {
              print_r($userRow['user_id']);
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <form action="book_edit.php" method="POST">
                    <tr>
                    <td><input style="border-width:0px;border:none;"type="text" name='id_book' value='<?php echo $row[0] ?>' readonly="readonly"></td>
                    <td><input style="border-width:0px;border:none;" type="text" name='name_book' value='<?php echo $row[1] ?>' readonly="readonly"></td>
                    <td><input style="border-width:0px;border:none;" type="text" name='author_book' value='<?php echo $row[2] ?>' readonly="readonly"></td>
                    <td><input style="border-width:0px;border:none;" type="text" name='price_book' value='<?php echo $row[3] ?>' readonly="readonly"></td>
                    <td><input type=submit class='btn btn-primary' value='Edit' name='submit1'></td>
                    </tr>
                    </form>
                    <?php
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