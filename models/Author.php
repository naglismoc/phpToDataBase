<?php
//include database
class Author
{
    public $id;
    public $name;
    public $surname;
    public $booksWritten;

    public function __construct($id = 0, $name = "", $surname = "",$booksWritten = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->booksWritten = $booksWritten;
    }

    public static function all()
    {
        $authors = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $result = $db->query("SELECT * from authors");
        while ($row = $result->fetch_assoc()) {
            $authors[] = new Author($row['id'], $row['name'], $row['surname']);
        }
        $db->close();
        return $authors;
    }

    public static function find($id)
    {
        $author = new Author();
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        // $sql = "SELECT * from authors where id = ?";
        $sql = " SELECT a.id, a.name, a.surname, count(a.id) as 'booksWritten'
        FROM `authors` a
        join books b 
        on a.id = b.author_id
        WHERE a.id = ?
        group by a.id;";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $author = new Author($row['id'], $row['name'], $row['surname'], $row['booksWritten']);
        }
        $db->close();

        return $author;
    }

    public function save()
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $sql = "INSERT INTO `authors`(`name`, `surname`) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $this->name, $this->surname);
        $stmt->execute();
        $db->close();
    }

    public function update()
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $sql = "UPDATE `authors` SET `name`= ?,`surname`= ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi", $this->name, $this->surname, $this->id);
        $stmt->execute();
        $db->close();
    }


    public static function destroy($id)
    {
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $sql = "DELETE FROM `authors` WHERE `id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
    }
}
