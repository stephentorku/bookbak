<?php 
class books{
    private $conn;
    private $table_name = "Books";

    public $title;
    public $category;
    public $author;
    public $quanitity;
    public $book_status;

    public function __construct($db){
        $this->conn = $db;
    }

    function allbooks(){
        $query = "SELECT
                    *
                FROM
                Books";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    
    }

    function getStudentBooks(){
        $studentid = $_SESSION['studentID'];
        $query =  "SELECT * FROM 
        Books 
        WHERE BookID
        IN(SELECT BookID FROM Borrowed_books WHERE StudentID =".$studentid.")";
         // prepare query statement
         $stmt = $this->conn->prepare($query);
         // execute query
         $stmt->execute();
         return $stmt;

    }
    function getDates(){
        $studentid = $_SESSION['studentID'];
        $query = "SELECT
                *
            FROM
            Borrowed_books WHERE StudentID =".$studentid."";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;  
    }
}

?>