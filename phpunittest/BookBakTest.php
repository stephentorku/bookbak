<?php 
use PHPUnit\Framework\TestCase;
class BookBakTest extends TestCase{
    public function testDirectory()
    {
        define('ROOT_PATH', dirname(__DIR__) . '/./');
        $this->assertDirectoryExists(ROOT_PATH.'User');
        $this->assertDirectoryExists(ROOT_PATH.'Admin');
    }

    public function testBookHasAttribute(){
        define('ROOT_PATH', dirname(__DIR__) . '/./');
        require(ROOT_PATH.'User/books.php');
        $this->assertClassHasAttribute('title', books::class);
        $this->assertClassHasAttribute('BookID', books::class);
        $this->assertClassHasAttribute('category', books::class);
        $this->assertClassHasAttribute('author', books::class);
        $this->assertClassHasAttribute('quantity', books::class);
    }

    public function testUserHasAttribute(){
        define('ROOT_PATH', dirname(__DIR__) . '/./');
        require(ROOT_PATH.'User/user.php');

        $this->assertClassHasAttribute('StudentID', User::class);
        $this->assertClassHasAttribute('fname', User::class);
        $this->assertClassHasAttribute('lname', User::class);
        $this->assertClassHasAttribute('year', User::class);
        $this->assertClassHasAttribute('curriculum', User::class);
        $this->assertClassHasAttribute('email', User::class);
        $this->assertClassHasAttribute('role', User::class);
        $this->assertClassHasAttribute('dob', User::class);
        $this->assertClassHasAttribute('gender', User::class);




    }

}


?>