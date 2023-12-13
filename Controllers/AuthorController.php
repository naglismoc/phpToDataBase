<?php
include "../../models/Author.php";
class AuthorController{

public static function getAll() {
    $authors = Author::all();
    return $authors;
}



}

?>