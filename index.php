<?php
include 'connection.php';

$message = '';
if (isset($_GET['message'])) {
    $message = trim($_GET['message']);
}

$students = [];

try {
    $stmt = $conn->query('SELECT * FROM Students ORDER BY id');
    $students = $stmt->fetchAll();
    
    // Reset auto-increment to 1 if table is empty
    if (count($students) === 0) {
        $conn->exec('ALTER TABLE Students AUTO_INCREMENT = 1');
    }
} catch (PDOException $e) {
    $message = 'Error loading students: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 8px; text-align: left; }
        form { margin-bottom: 20px; }
        .message { margin-bottom: 20px; padding: 10px; background: #f2f2f2; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h1>Student Management</h1>

    <?php if ($message !== ''): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <h2>Add New Student</h2>
    <form method="post" action="insert_form.php">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Course: <input type="text" name="course" required><br><br>
        <button type="submit">Add Student</button>
    </form>

    <h2>Update Student by ID</h2>
    <form method="post" action="update.php">
        ID: <input type="number" name="id" min="1" required><br><br>
        Name: <input type="text" name="name" ><br><br>
        Email: <input type="email" name="email" ><br><br>
        Course: <input type="text" name="course" ><br><br>
        <button type="submit">Update Student</button>
    </form>

    <h2>Delete Student by ID</h2>
    <form method="post" action="delete.php">
        ID: <input type="number" name="id" min="1" required>
        <button type="submit">Delete Student</button>
    </form>

    <h2>Students Table</h2>
    <?php if (count($students) === 0): ?>
        <p>No student records found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['Id']); ?></td>
                        <td><?php echo htmlspecialchars($student['Name']); ?></td>
                        <td><?php echo htmlspecialchars($student['Email']); ?></td>
                        <td><?php echo htmlspecialchars($student['Course']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>