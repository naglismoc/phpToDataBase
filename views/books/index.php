<?php
include "../../Controllers/AuthorController.php";
include "../../Controllers/BookController.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    BookController::destroy($_POST['id']);
    header("Location: ./index.php");
}

$books = BookController::getAll();

include_once "../components/head.php";
?>

    <div class="container">
        <h1>Čia yra knygos</h1>
        <a class="btn btn-success" href="./create.php">sukurti</a>
        <a class="btn btn-primary" href="../authors/index.php">Pamatyti autorių sąrašą</a>

        <table class="table table-striped">
            <tr>
                <th>nr.</th>
                <th>id</th>
                <th>pavadinimas</th>
                <th>žanras</th>
                <th>valdymas</th>
            </tr>
            <?php foreach ($books as $key => $book) { ?>
                <tr>
                    <td> <?= $key + 1 ?> </td>
                    <td> <?= $book->id ?> </td>
                    <td> <?= $book->title ?> </td>
                    <td> <?= $book->genre ?> </td>
                    <td>
                        <div class="d-inline-block">
                            <a class="btn btn-primary" href="./show.php?id=<?= $book->id ?>">show</a>
                        </div>
                        <div class="d-inline-block">
                            <form action="./edit.php" method="get">
                                <input type="hidden" name="id" value="<?= $book->id ?>">
                                <button class="btn btn-success" type="submit">edit</button>
                            </form>
                        </div>
                        <div class="d-inline-block">
                            <form action="./index.php" method="post">
                                <input type="hidden" name="id" value="<?= $book->id ?>">
                                <button class="btn btn-danger" type="submit">delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
    <?php
include "../components/footer.php";
?>