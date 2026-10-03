<?php

include ('../connection.php');


if (isset($_POST['delete'])) {
    $id=$_POST['id'];
    
    $sql = "DELETE  FROM book WHERE book_id='$id'";

    $query = mysqli_query($connection, $sql);

    if ($query) {
        echo "delete success";
    } else {
        echo "delete fail";
    }
}

?>