<?php
include "../../models/Book.php";
class BookController
{

    public static function getAll()
    {
        $books = Book::all();
        return $books;
    }

    public static function find($id)
    {
        $book = Book::find($id);
        return $book;
    }

    public static function findByAuthor($id) {
        $books = Book::findByAuthor($id);
        return $books;
    }
    public static function store()
    {
        $book = new Book();
        $book->title = $_POST['title'];
        $book->genre = $_POST['genre'];
        $book->author_id = $_POST['author_id'];
        $book->save();
    }
    public static function update($id)
    {
        $book = Book::find($id);
        $book->title = $_POST['title'];
        $book->genre = $_POST['genre'];
        $book->author_id = $_POST['author_id'];
        $book->update();
    }

    public static function destroy($id)
    {
        Book::destroy($id);
    }
}
