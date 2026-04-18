<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

try {
    $id = (int) ($_POST['id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if ($id <= 0 || $name === '' || $email === '' || $course === '') {
        throw new Exception('Please provide a valid ID, name, email, and course for update.');
    }

    $sql = 'UPDATE Students SET name = :name, email = :email, course = :course WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':email' => $email,
        ':course' => $course,
    ]);

    if ($stmt->rowCount() === 0) {
        throw new Exception('No student found with that ID.');
    }

    $message = 'Student updated successfully.';
} catch (Exception $e) {
    $message = 'Error: ' . $e->getMessage();
}

header('Location: index.php?message=' . urlencode($message));
exit;
?>