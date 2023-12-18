<?php
if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

include_once "../../Controllers/AuthorController.php";
include_once "../../Controllers/BookController.php";
$book = BookController::find($_GET['id']);
// $author = AuthorController::find($book->author_id);

include_once "../components/head.php";
?>

<div class="row">
    <div class="col"></div>
    <div class="col-6">


        <div class="card" style="width: 100%;">
            <img src="../../images/book.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $book->title ?></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Book genre: <?= $book->genre ?></li>
                <li class="list-group-item"><a href="../authors/show.php?id=<?= $book->author->id ?>"><?= $book->author->name . " " . $book->author->surname ?></a></li>
                <li class="list-group-item">A third item</li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">Books link</a>
                <a href="./index.php" class="card-link">Show all books</a>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>
<?php
include "../components/footer.php";
?>


<!-- login, file upload, filter sort, session, /*components*/, messages -->