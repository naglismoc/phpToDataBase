<?php
//include database
class Author
{
    public $id;
    public $name;
    public $surname;

    public function __construct($id = 0, $name = "", $surname = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
    }

    public static function all()
    {
        $authors = [];
        $db = new mysqli("localhost", "root", "", "web_11_23_library");
        $result = $db->query("SELECT * from authors");
        while ($row = $result->fetch_assoc()) {
            $authors[] = new Author($row['id'], $row['name'], $row['surname']);
        }
        return $authors;
    }
}
