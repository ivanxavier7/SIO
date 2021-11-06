<?php include "header.php"; ?>
<?php include "db.php"; ?>
<?php include "functions.php"; ?>

<table class="table" id="tab_livros">
        <thead>
                <tr>
                        <th scope="col">#</th>
                        <th scope="col">Livro</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Preço (€)</th>
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
<?php include "footer.php"; ?>