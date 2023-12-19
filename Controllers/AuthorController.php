<?php
include "../../models/Author.php";
class AuthorController{

public static function getAll() {
    $authors = Author::all();
    return $authors;
}

public static function find($id){
    $author = Author::find($id);
    return $author;
}

public static function store() {
    if (strlen($_POST['name']) == 0) {
        $errors[] = " vardas per trumpas";
    }
    
    if (strlen($_POST['surname']) == 0) {
        $errors[] = " pavarde per trumpa";
    }
    if($errors){
        $_SESSION['alert'] = $errors;
        return false;
    }
    $author = new Author();
    $author->name = $_POST['name'];
    $author->surname = $_POST['surname'];
    $author->save();
    return true;
}
public static function update($id) {
    $author = Author::find($id);
    $author->name = $_POST['name'];
    $author->surname = $_POST['surname'];
    $author->update();
}

public static function destroy($id) {
    Author::destroy($id);
}

}

?>