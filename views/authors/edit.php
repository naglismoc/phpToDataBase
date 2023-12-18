<?php
include "../../Controllers/AuthorController.php";

//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    AuthorController::update($_POST['id']);
    header("Location: ./index.php");
}

if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

$author = AuthorController::find($_GET['id']);
// print_r($author);die;

include_once "../components/head.php";
?>

    <div class="container mt-5 ">
        <div class="row bg-secondary bg-gradient bg-opacity-25">
            <div class="col"></div>
            <div class="col-6">
                <form action="./edit.php" method="post">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?=$author->name?>">
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname:</label>
                        <input type="text" class="form-control" name="surname" placeholder="Enter Surname" value="<?=$author->surname?>">
                    </div>
                    <input type="hidden" name="id" value="<?=$author->id?>">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <?php
include "../components/footer.php";
?>