<?php
session_start();
include 'header.php';
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>You must be logged in to view this page. <a href='login.php'>Login here</a></p>";
    include 'footer.php';
    exit;
}

// Fetch the record if an ID is provided
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$record) {
        echo "<p>Record not found.</p>";
        include 'footer.php';
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];
    $image = $_FILES['image']['name'];
    
    // Fetch the current record's image
    $sql = "SELECT image FROM students WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $current_image = $stmt->fetchColumn();

    if ($image) {
        // New image is uploaded
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } else {
        // No new image uploaded, keep the existing image
        $image = $current_image;
    }

    $sql = "UPDATE students SET name = ?, age = ?, grade = ?, image = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$name, $age, $grade, $image, $id])) {
        echo "<p>Record updated successfully. <a href='read.php'>Go back to records</a></p>";
        echo '<p>Redirecting in <span id="countdown">5</span> seconds...</p>';
        echo '<script>
            var countdown = 5;
            var interval = setInterval(function() {
                countdown--;
                document.getElementById("countdown").textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = "view.php";
                }
            }, 1000);
        </script>';
        include 'footer.php';
        exit;
    } else {
        echo "Error: " . $pdo->errorInfo()[2];
    }
}
?>

<h2>Update Record</h2>
<form action="update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($record['name']); ?>" required>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($record['age']); ?>" required>

    <label for="grade">Grade:</label>
    <input type="text" id="grade" name="grade" value="<?php echo htmlspecialchars($record['grade']); ?>" required>

    <label for="image">Image:</label>
    <input type="file" id="image" name="image">
    <?php if (!empty($record['image'])): ?>
        <p>Current Image:</p>
        <img src="images/<?php echo htmlspecialchars($record['image']); ?>" alt="Image" style="width: 300px; height: auto;">
    <?php endif; ?>
    <button type="submit">Update Student</button>
</form>

<footer>
    <p>&copy; 2024 Student Record Management</p>
</footer>
</body>
</html>
