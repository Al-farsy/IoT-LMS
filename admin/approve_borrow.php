<?php

session_start();
include('../connection.php');

if (isset($_POST['approve'])) {

    $borrow_id = $_POST['borrow_id'];

    $admin_user_id = $_SESSION['user_id'];
    echo "Admin User ID: " . $admin_user_id;

    $sql = "SELECT id FROM admin
            WHERE user_id='$admin_user_id'";

    $result = mysqli_query($connection, $sql);

    $admin = mysqli_fetch_assoc($result);

    $admin_id = $admin['id'];

    $sql = "SELECT * FROM borrow
            WHERE borrow_id='$borrow_id'";

    $result = mysqli_query($connection, $sql);

    $borrow = mysqli_fetch_assoc($result);

    $book_id = $borrow['book_id'];

    $sql = "SELECT quantity FROM book
            WHERE book_id='$book_id'";

    $result = mysqli_query($connection, $sql);

    $book = mysqli_fetch_assoc($result);


    if ($book['quantity'] > 0) {

        $sql = "UPDATE book
                SET quantity = quantity - 1
                WHERE book_id='$book_id'";

        mysqli_query($connection, $sql);

        $sql = "UPDATE borrow
                SET status='approved',
                    admin_id='$admin_id'
                WHERE borrow_id='$borrow_id'";

        mysqli_query($connection, $sql);

        echo "Borrow request approved.";
    } else {
        echo "Book is no longer available.";

    }
}

?>
<br><br>
<a href="borrow_request.php">
    ← Back to Requests
</a>
