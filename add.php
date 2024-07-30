<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add Student</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="add.php">Add Student</a></li>
                <li><a href="view.php">View Students</a></li>
            </ul>
        </nav>
        <h1>Add Student</h1>
    </header>
    <main>
        <form action="insert.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            <label for="grade">Grade:</label>
            <input type="text" id="grade" name="grade" required>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <button type="submit">Add Student</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Student Record Management</p>
    </footer>
</body>
</html>
