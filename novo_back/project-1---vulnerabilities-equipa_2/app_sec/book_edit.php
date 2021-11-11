<?php include "header.php"; ?>
<?php include "functions.php"; ?>
<?php EditBook() ?>

<?php
if (isset($_POST['submit1'])) {
  $id = $_POST['id_book'];
  $name = $_POST['name_book'];
  $author = $_POST['author_book'];
  $price = $_POST['price_book'];
?>
  <div class="container">
    <div class="col-sm-6">
      <form action="book_edit.php" method="POST">
        <div class="form-group">
          <label for="id_book">#</label>
          <input type="number" name="id_book" id="" class="form-control" aria-describedby="helpId" value="<?php echo $id ?>" readonly="readonly">
        </div>
        <div class="form-group">
          <label for="name_book">Name</label>
          <input type="text" name="name_book" id="" class="form-control" aria-describedby="helpId" value="<?php echo $name ?>">
        </div>
        <div class="form-group">
          <label for="author_book">Author</label>
          <input type="text" name="author_book" id="" class="form-control" aria-describedby="helpId" value="<?php echo $author ?>">
        </div>
        <div class="form-group">
          <label for="price_book">Price</label>
          <input type="number" step="any" name="price_book" id="" class="form-control" aria-describedby="helpId" value="<?php echo $price ?>">
        </div>

        <button type="submit" name="submit2" class="btn btn-primary">Submit</button>

      </form>
    </div>
  </div>
<?php } ?>
<?php include "footer.php"; ?>