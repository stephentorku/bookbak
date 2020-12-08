drop database if exists ST40212022;
create schema ST40212022;
use ST40212022;

create table Students(
StudentID int AUTO_INCREMENT,
fname varchar(50) NOT NULL,
lname varchar(50) NOT NULL,
dob date,
gender varchar(10), 
yeargroup varchar(15), 
curriculum varchar(50),
email varchar(50),
password varchar(50),
role varchar(1),
primary key(StudentID)
);

create table Adminstrator(
ID int AUTO_INCREMENT,
 username varchar(30) NOT NULL, 
 passkey varchar(20) NOT NULL,
 primary key(ID)
 );
 
create table Books(
BookID int AUTO_INCREMENT, 
Title varchar(80) NOT NULL, 
Category varchar(30), 
Author varchar(70) NOT NULL,
Quantity int,
Book_Status enum('good condition','damaged'), 
primary key (BookID)
);

create table Borrowed_books(
 Expected_ReturnDate date, 
 Date_Borrowed date ,
 StudentID int, 
 BookID int,
 foreign key (StudentID) references Students(StudentID),
 foreign key (BookID) references Books(BookID) 
 );


create table messages(
 date_sent timestamp NOT NULL DEFAULT current_timestamp(),
 topic varchar(100),
 memo text,
 StudentID int, 
 BookID int,
 foreign key (StudentID) references Students(StudentID),
 foreign key (BookID) references Books(BookID) 
 );
 
create table Return_status(
Date_returned date, 
Return_status enum('good condition','damaged'), 
StudentID int, 
BookID int,
foreign key (StudentID) references Students(StudentID),
foreign key (BookID) references Books(BookID)
);