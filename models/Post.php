<?php

class Post{
    //DB staff
    private $conn;
    private $table = 'posts';

    //Post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    //Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get posts
    public function read()
    {
        // create a query
        $query = 'SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
    FROM ' . $this->table . ' p
    LEFT JOIN categories c ON p.category_id = c.id
    ORDER BY p.created_at DESC';

        // Prepared statement
        $stmt = $this->conn->prepare($query);

        // Execute the query
        $stmt->execute();

        return $stmt;

    }


    // Read single post
    public function read_single()
    {
         // create a query
         $query = 'SELECT 
         c.name as category_name,
         p.id,
         p.category_id,
         p.title,
         p.body,
         p.author,
         p.created_at
     FROM ' . $this->table . ' p
     LEFT JOIN categories c ON p.category_id = c.id
     WHERE p.id = ?
     LIMIT 0,1';
 
         // Prepared statement
         $stmt = $this->conn->prepare($query);

         // Bind ID 
         $stmt->bindParam(1, $this->id);
 
         // Execute the query
         $stmt->execute();


         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         // SET PROPERTIES
         $this->title = $row['title'];
         $this->body = $row['body'];
         $this->author = $row['author'];
         $this->category_id = $row['category_id'];
         $this->category_name = $row['category_name'];

 
         return $stmt;
    }



    // 
}


?>