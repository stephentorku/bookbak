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
    function DayBooks(){
        //Select all Query
        $query = "SELECT
                    *
                FROM
                    Borrowed_books 
                WHERE               
                Expected_ReturnDate = CURDATE()";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    function DayBooksDisplay(){
        //Select all Query
        $query =  "SELECT
                    *
                FROM
                    Borrowed_books
                RIGHT JOIN Books ON Borrowed_books.BookID = Books.BookID 
                WHERE Borrowed_books.Expected_ReturnDate= CURDATE()";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


    function getStudentBooks(){
        $studentid = $_SESSION['studentID'];
        $query =  "SELECT Borrowed_books.BookID, Borrowed_books.Expected_ReturnDate, Borrowed_books.Date_Borrowed, Books.Title,
        Books.Category, Books.Author, Books.Quantity, Books.Book_Status
        FROM Borrowed_books
        RIGHT JOIN Books
        ON Borrowed_books.BookID = Books.BookID
        WHERE Borrowed_books.StudentID = '$studentid'";
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