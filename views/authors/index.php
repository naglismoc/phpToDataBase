<?php
include "../../Controllers/AuthorController.php";
$authors = AuthorController::getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Čia yra autoriai</h1>
        <a class="btn btn-success" href="./create.php">sukurti</a>
        <table class="table table-striped">
            <tr>
                <th>nr.</th>
                <th>id</th>
                <th>name</th>
                <th>surname</th>
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
                        <a class="btn btn-primary" href="">show</a>
                    </div>
                        <div class="d-inline-block">
                            <form action="" method="post">
                                <button class="btn btn-success" type="submit">edit</button>
                            </form>
                        </div>
                        <div  class="d-inline-block">
                            <form action="" method="post">
                                <button class="btn btn-danger" type="submit">delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</body>

</html>