<?php
class Book
{
    public $id;
    public $title;
    public $genre;
    public $photo;
    public $author_id;
    public $author;
    public function __construct($id = 0, $title = "", $genre = "", $photo = "", $author_id = 0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->genre = $genre;
        $this->photo = $photo;
        $this->author_id = $author_id;
        $this->author = ($author_id != 0) ? AuthorController::find($author_id) : new Author();
    }

    // public static function all($author_id = 0)
    // {
    //     $books = [];
    //     $db = new mysqli("localhost", "root", "", "web_11_23_library");
    //     $result = $db->query("SELECT * from books");
    //     while ($row = $result->fetch_assoc()) {
    //         $books[] = new Book($row['id'], $row['title'], $row['genre'], $row['author_id']);
    //     }
    //     $db->close();
    //     return $books;
    // }
    public static function all($author_id = 0)
    {
        $books = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $sql = "SELECT * from books";
        if ($author_id != 0) {
            $sql .= " where author_id = ?";
        }
        $stmt = $db->prepare($sql);
        if ($author_id != 0) {
            $stmt->bind_param("i", $author_id);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $books[] = new Book($row['id'], $row['title'], $row['genre'], $row['author_id']);
        }
        $db->close();
        return $books;
    }

    public static function find($id)
    {
        $book = new Book();
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $sql = "SELECT id,title,genre,photo,author_id from books where id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $book = new Book($row['id'], $row['title'], $row['genre'], $row['photo'], $row['author_id']);
        }
        $db->close();

        return $book;
    }

    public function save()
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $sql = "INSERT INTO `books`(`title`, `genre`,`photo`,`author_id`) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssi", $this->title, $this->genre, $this->photo, $this->author_id);
        $stmt->execute();
        $db->close();
    }

    public function update()
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $sql = "UPDATE `books` SET `title`= ?,`genre`= ?, `photo`= ? ,`author_id`= ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssii", $this->title, $this->genre, $this->photo, $this->author_id, $this->id);
        $stmt->execute();
        $db->close();
    }


    public static function destroy($id)
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $sql = "DELETE FROM `books` WHERE `id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
    }
}
