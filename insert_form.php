<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

try {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if ($name === '' || $email === '' || $course === '') {
        throw new Exception('Please provide name, email, and course.');
    }

    $sql = 'INSERT INTO Students (name, email, course) VALUES (:name, :email, :course)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':course' => $course,
    ]);

    $message = 'Student added successfully.';
} catch (Exception $e) {
    $message = 'Error: ' . $e->getMessage();
}

header('Location: index.php?message=' . urlencode($message));
exit;
?>