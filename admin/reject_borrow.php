<?php

include('../connection.php');

if (isset($_POST['reject'])) {

    $borrow_id = $_POST['borrow_id'];

    $sql = "UPDATE borrow
            SET status='rejected'
            WHERE borrow_id='$borrow_id'";

    if (mysqli_query($connection, $sql)) {

        echo "Borrow request rejected.";

    } else {

        echo "Failed to reject request.";

    }

}

?>

<br><br>

<a href="borrow_request.php">
    ← Back to Requests
</a>
