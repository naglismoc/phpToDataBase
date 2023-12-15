<?php
include "../../Controllers/BookController.php";
include "../../Controllers/AuthorController.php";

$authors = AuthorController::getAll();

//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    BookController::update($_POST['id']);
    header("Location: ./index.php");
}

if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

$book = BookController::find($_GET['id']);
// print_r($book);die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="bg-light">
    <div class="container mt-5 ">
        <div class="row bg-secondary bg-gradient bg-opacity-25">
            <div class="col"></div>
            <div class="col-6">
            <form action="./edit.php" method="POST">
                    <div class="form-group">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title" value="<?=$book->title?>">
                    </div>
                    <div class="form-group">
                        <label for="surname">Genre:</label>
                        <input type="text" class="form-control" name="genre" placeholder="Enter genre" value="<?=$book->genre?>">
                    </div>
                    <div class="form-group">
                        <label for="book">book:</label>
                        <div id="emailHelp" class="form-text">Create an book <a href="../books/create.php">here</a> if it does not exists </div>
  
                        <select class="form-select " id="book" name="author_id" aria-label="Default select example">
                            <?php
                            foreach ($authors as $author) { ?>
                                <option <?= ($book->author_id == $author->id) ? "selected" : "" ?> value="<?= $author->id ?>"><?= $author->name . " " . $author->surname ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?=$book->id?>">

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

</body>

</html>