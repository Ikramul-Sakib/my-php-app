<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

try {
    $id = (int) ($_POST['id'] ?? 0);

    if ($id <= 0) {
        throw new Exception('Please provide a valid ID to delete.');
    }

    $sql = 'DELETE FROM Students WHERE id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() === 0) {
        throw new Exception('No student found with that ID.');
    }

    $message = 'Student deleted successfully.';
} catch (Exception $e) {
    $message = 'Error: ' . $e->getMessage();
}

header('Location: index.php?message=' . urlencode($message));
exit;
