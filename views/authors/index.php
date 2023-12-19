<?php

include "../../Controllers/AuthorController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    AuthorController::destroy($_POST['id']);
    header("Location: ./index.php");
}

$authors = AuthorController::getAll();

include_once "../components/head.php";

?>

<div class="container">

    <h1>Čia yra autoriai</h1>
    <a class="btn btn-success" href="./create.php">sukurti</a>
    <a class="btn btn-primary" href="../books/index.php">Pamatyti knygų sąrašą</a>



    <table class="table table-striped">
        <tr>
            <th>nr.</th>
            <th>id <a href="./index.php?orderBy=id&order=asc">▲</a> <a href="./index.php?orderBy=id&order=desc">▼</a></th>
            <th>name <a href="./index.php?orderBy=name&order=asc">▲</a> <a href="./index.php?orderBy=name&order=desc">▼</a></th>
            <th>surname <a href="./index.php?orderBy=surname&order=asc">▲</a> <a href="./index.php?orderBy=surname&order=desc">▼</a></th>
            <th>valdymas</th>
        </tr>
        <?php foreach ($authors as $key => $author) { ?>
            <tr>
                <td> <?= $key + 1 ?> </td>
                <td> <?= $author->id ?> </td>
                <td> <?= $author->name ?> </td>
                <td> <?= $author->surname ?> </td>
                <td>
                    <div class="d-inline-block">
                        <a class="btn btn-primary" href="./show.php?id=<?= $author->id ?>">show</a>
                    </div>
                    <div class="d-inline-block">
                        <form action="./edit.php" method="get">
                            <input type="hidden" name="id" value="<?= $author->id ?>">
                            <button class="btn btn-success" type="submit">edit</button>
                        </form>
                    </div>
                    <div class="d-inline-block">
                        <form action="./index.php" method="post">
                            <input type="hidden" name="id" value="<?= $author->id ?>">
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