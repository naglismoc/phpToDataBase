<?php
include_once "../components/head.php";


include "../../Controllers/AuthorController.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(AuthorController::store()){
        $_SESSION["success"] = "Autorius sėkmingai sukurtas";
        header("Location: ./index.php");
    die;
    }
print_r($_POST);
// die;
    
}

?>

    <div class="container mt-5 ">
        <div class="row bg-secondary bg-gradient bg-opacity-25">
            <div class="col"></div>
            <div class="col-6">
                <form action="./create.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?=(isset($_POST['name'])) ? $_POST['name'] : "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname:</label>
                        <input type="text" class="form-control" name="surname" placeholder="Enter Surname" value="<?=(isset($_POST['surname'])) ? $_POST['surname'] : "" ?>">
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