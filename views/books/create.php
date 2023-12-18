<?php
include "../../Controllers/BookController.php";
include "../../Controllers/AuthorController.php";

$authors = AuthorController::getAll();
//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    BookController::store();
    header("Location: ./index.php");
}

include_once "../components/head.php";
?>

    <div class="container mt-5 ">
        <div class="row bg-secondary bg-gradient bg-opacity-25">
            <div class="col"></div>
            <div class="col-6">
                <form action="./create.php" method="POST">
                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="surname">Genre:</label>
                        <input type="text" class="form-control" name="genre" placeholder="Enter genre">
                    </div>
                    <div class="form-group">
                        <label for="author">author:</label>
                        <div id="emailHelp" class="form-text">Create an author <a href="../authors/create.php">here</a> if it does not exists </div>
  
                        <select class="form-select " id="author" name="author_id" aria-label="Default select example">
                            <?php
                            foreach ($authors as $author) { ?>
                                <option value="<?= $author->id ?>"><?= $author->name . " " . $author->surname ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <?php
include "../components/footer.php";
?>