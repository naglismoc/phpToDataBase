<?php
include_once "../components/head.php";

include "../../Controllers/AuthorController.php";
include "../../Controllers/BookController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    BookController::destroy($_POST['id']);
    header("Location: ./index.php");
}
if(isset($_GET['author_id'])){
    $books = BookController::getAll($_GET['author_id']);    
}else{
    $books = BookController::getAll();
}
$authors = AuthorController::getAll();

?>

<div class="container">
    <h1>Čia yra knygos</h1>
    <div class="row">
        <div class="col-4">

            <a class="btn btn-success" href="./create.php">sukurti</a>
            <a class="btn btn-primary" href="../authors/index.php">Pamatyti autorių sąrašą</a>
        </div>
        <div class="col">
            <form action="" method="get">
                <div class="row">
                    <div class="col">
                        <select class="form-select " id="author" name="author_id" aria-label="Default select example">
                            <option value="0">Pasirinkti autorių</option>
                            <?php
                            foreach ($authors as $author) { ?>
                                 <option <?= ($author->id == $_GET['author_id']) ? "selected" : "" ?> value="<?= $author->id ?>"><?= $author->name . " " . $author->surname ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">filtruoti</button>

                    </div>
                </div>

            </form>
        </div>
        <div class="col-"></div>
    </div>
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
                    <?php if(true){  // jei prisijunges?>
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
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>

    </table>
</div>
<?php
include "../components/footer.php";
?>