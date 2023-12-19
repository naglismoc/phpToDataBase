<?php
include "../../models/Book.php";
class BookController
{

    public static function getAll($author_id = 0)
    {
        $books = Book::all($author_id);
        return $books;
    }

    public static function find($id)
    {
        $book = Book::find($id);
        return $book;
    }

    public static function findByAuthor($id)
    {
        $books = Book::all($id);
        return $books;
    }
    public static function store()
    {
        $uploadDir = '../../images/booksPhotos/'; // Create a folder named 'uploads' to store uploaded files

        $fileType = explode("/", $_FILES['photo']['type'])[1];
        $fileName = BookController::generateRandomString(7) . "." . $fileType;
        $uploadFile = $uploadDir . $fileName;
        // echo $uploadFile;die;

        // print_r();
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile);
        // die;
        // $photo = "";
        $book = new Book();
        $book->title = $_POST['title'];
        $book->genre = $_POST['genre'];
        $book->photo = $fileName;
        $book->author_id = $_POST['author_id'];
        $book->save();
    }
    public static function update($id)
    {
        $book = Book::find($id);
        $photo = $book->photo;
        $uploadDir = '../../images/booksPhotos/';
        // print_r( $_FILES['photo']);die;
        // var_dump(isset($_POST['remove_photo']), $_POST['photo'] != "");die;
        if (isset($_POST['remove_photo']) ||  $_FILES['photo'] != "") {
            if (file_exists($uploadDir . $photo)) {
                unlink($uploadDir . $photo);
            }
            $photo = null;
        }
        // print_r($_FILES['photo']);die;
        if (isset( $_FILES['photo']) && $_FILES['photo']['name'] != "") {
            // print_r($_FILES);
            // die;
            $fileType = explode("/", $_FILES['photo']['type'])[1];
            $fileName = BookController::generateRandomString(7) . "." . $fileType;
            $uploadFile = $uploadDir . $fileName;

            move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile);
            $photo = $fileName;
        }
        // print_r( $photo);die;


        $book->title = $_POST['title'];
        $book->genre = $_POST['genre'];
        $book->photo = $photo;
        $book->author_id = $_POST['author_id'];
        $book->update();
    }

    public static function destroy($id)
    {
        Book::destroy($id);
    }

    static function generateRandomString($length = 7)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
