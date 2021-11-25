<?php
/*
This file contains database configuration assuming that we are running mysql using user "root" and password ""
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'email_services');

$error = '';


// Connect to MySQL
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If database is not exist create one
if (!mysqli_select_db($conn, DB_NAME)) {
    $sql = "CREATE DATABASE " . DB_NAME;
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}



// creating user table
// sql statement to create user table
$create_user_table = 'CREATE TABLE `email_services`.`user` ( `first_name` VARCHAR(50) NOT NULL , `last_name` VARCHAR(50) NOT NULL , `gender` VARCHAR(10) NOT NULL , `dob` DATE NOT NULL , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(50) NOT NULL ) ENGINE = InnoDB;';

// create table if not exists
mysqli_query($conn, $create_user_table);

// query for making email as primary key
$sql = "ALTER TABLE `user` ADD PRIMARY KEY(`email`)";
mysqli_query($conn, $sql);


// create email table
$create_email_table = 'CREATE TABLE `email_services`.`emails` (`id` INT AUTO_INCREMENT PRIMARY KEY, `sender` VARCHAR(100) NOT NULL , `reciver` VARCHAR(100) NOT NULL , `subject` VARCHAR(400) NOT NULL , `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , `content` TEXT NOT NULL ) ENGINE = InnoDB;';

// create table if not exists
mysqli_query($conn, $create_email_table);


// setting sender as a foreign key
$relationship_sender = 'ALTER TABLE `email_services`.`emails` ADD CONSTRAINT `sender_email` FOREIGN KEY (`sender`) REFERENCES `user`(`email`) ON DELETE RESTRICT ON UPDATE RESTRICT;';

$relationship_reciver = 'ALTER TABLE `email_services`.`emails` ADD CONSTRAINT `reciver_email` FOREIGN KEY (`reciver`) REFERENCES `user`(`email`) ON DELETE RESTRICT ON UPDATE RESTRICT;';

mysqli_query($conn, $relationship_sender);
mysqli_query($conn, $relationship_reciver);

// adding primary key to emails table
// $sql = 'ALTER TABLE emails ADD [COLUMN] new_column_name AUTO_INCREMENT PRIMARY KEY;'



// function for checking email exist or not
function emailExists($email){
    $sql = "SELECT email FROM user where email = '" . $email . "'";
    global $conn; 
    $result = $conn->query($sql);

    if ($result->num_rows != 0) {
        $message = true;
    }
    else{
        $message = false;
    }
    return $message;
}


?>
