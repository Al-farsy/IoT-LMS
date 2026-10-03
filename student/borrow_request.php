<?php

session_start();
include('../connection.php');

if (isset($_POST['borrow'])) {

    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id'];

    // Kupata student ID
    $sql = "SELECT id FROM student
            WHERE user_id='$user_id'";

    $result = mysqli_query($connection, $sql);

    $student = mysqli_fetch_assoc($result);

    if (!$student) {
        die("Student account not connected to this login.");
    }

    $student_id = $student['id'];

    // Kutuma borrow request
    $sql = "INSERT INTO borrow
            (book_id, student_id, status, admin_id)
            VALUES
            ('$book_id', '$student_id', 'pending', NULL)";

    if (mysqli_query($connection, $sql)) {

        echo "Borrow request sent successfully.";

    } else {

        echo "Failed to send borrow request: " . mysqli_error($connection);

    }
}

?>

<br><br>

<a href="borrow.php">
    ← Back to Books
</a>
