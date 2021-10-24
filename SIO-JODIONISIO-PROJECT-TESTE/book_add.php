<?php include "header.php"?>
<?php include "functions.php"; ?>
<?php AddBook()?>

<div class="container">
    <div class="col-sm-6">
        <form action="book_add.php" method="POST">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Please insert the book name</small>
            </div>
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" name="author" id="" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Please inser the book author</small>
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" step="any" name="price" id="" class="form-control" placeholder="" aria-describedby="helpId">
              <small id="helpId" class="text-muted">Please inser the book price</small>
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            
        </form>
    </div>
</div>
<?php include "footer.php"?>