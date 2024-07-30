<?php
// Database connection details
$host = "localhost";
$user = "root";
$pass = "root";
$db = "students_records";

try {
    // Establish a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    die("Could not connect to the database $db: " . $e->getMessage());
}

// SQL to create the database schema (not typically executed on every request)
// Uncomment the following lines and execute once to create the tables

/*
CREATE DATABASE IF NOT EXISTS student_records;

USE students_records;

CREATE TABLE students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    age INT(3) NOT NULL,
    grade VARCHAR(5) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
*/

?>
