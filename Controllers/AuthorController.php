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
    $author = new Author();
    $author->name = $_POST['name'];
    $author->surname = $_POST['surname'];
    $author->save();
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