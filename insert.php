<?php
include "connection.php";
try {
    $name = "Dia";
    $email = "sadia@gmail.com";
    $course = "CSE";

    $sql = "INSERT INTO Students (name, email, course) VALUES (:name, :email, :course)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':course' => $course,
    ]);

    echo "Data inserted successfully<br>";
} catch (PDOException $e) {
    echo "Insertion failed: " . $e->getMessage() . "<br>";
}
?>