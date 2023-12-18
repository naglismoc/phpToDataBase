<?php
if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

include "../../Controllers/AuthorController.php";
include "../../Controllers/BookController.php";
$author = AuthorController::find($_GET['id']);
$books = BookController::findByAuthor($_GET['id']);


include_once "../components/head.php";
?>

    <div class="row">
        <div class="col"></div>
        <div class="col-6">


            <div class="card" style="width: 100%;">
                <img src="../../images/best-selling-author.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$author->name . " " . $author->surname ?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Books Written: <?=$author->booksWritten?></li>
                    <?php foreach ($books as $book) { ?>
                        <li class="list-group-item"><?= $book->title?></li>

                 <?php   } ?>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Books link</a>
                    <a href="./index.php" class="card-link">Show all authors</a>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <?php
include "../components/footer.php";
?>