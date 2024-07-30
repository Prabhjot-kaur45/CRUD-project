<?php 
//session_start(); ?>
<header>
    <nav>
        <ul>
            <li><a href="add.php">Add Student</a></li>
            <li><a href="view.php">View Students</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <h1>Student Record Management</h1>
</header>
