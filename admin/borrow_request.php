<?php

session_start();
include('../connection.php');

$sql = "SELECT borrow.borrow_id,
               borrow.borrow_date,
               borrow.status,
               book.book_name,
               book.author,
               student.name,
               student.registration_number
        FROM borrow
        JOIN book ON borrow.book_id = book.book_id
        JOIN student ON borrow.student_id = student.id
        WHERE borrow.status = 'pending'
        ORDER BY borrow.borrow_id DESC";

$result = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Borrow Requests</title>

<style>

body {
    margin: 0;
    font-family: Arial;
     background:
    linear-gradient(
      45deg,
      rgba(208, 219, 218, 0.1) 0%,
      rgba(71, 230, 182, 0.36) 10%
    ),
    linear-gradient(
      90deg,
      rgba(129, 138, 175, 0.56) 10%,
      rgba(228, 225, 224, 0.55) 60%
    );
    color: #0d4134;
}

.main {
    padding: 30px;
}

h1 {
    margin-bottom: 25px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px #ddd;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #0d4134;
    color: white;
    padding: 14px;
    text-align: left;
}

td {
    padding: 14px;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background: #f5faf8;
}

button {
    border: none;
    padding: 9px 14px;
    border-radius: 7px;
    color: white;
    cursor: pointer;
}

.approve {
    background: #198754;
}

.reject {
    background: #d63031;
}
#man{
    border-radius: 15px;
    background-color: grey;
    position:absolute;
    right:10%;
}
#man a{
    padding:20px;
    text-decoration: none;
    color: white;
    font-size: large;
}
#man:hover{
    background-color: #0a3822;
}
</style>

</head>

<body>

<div class="main">

<h1>📚 Borrow Requests</h1>

<div class="card">

<table>

<tr>

    <th>Student</th>
    <th>Registration</th>
    <th>Book</th>
    <th>Author</th>
    <th>Date</th>
    <th>Action</th>

</tr>

<?php

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

?>

<tr>

    <td>
        <?php echo $row['name']; ?>
    </td>

    <td>
        <?php echo $row['registration_number']; ?>
    </td>

    <td>
        <?php echo $row['book_name']; ?>
    </td>

    <td>
        <?php echo $row['author']; ?>
    </td>

    <td>
        <?php echo $row['borrow_date']; ?>
    </td>

    <td>

        <form action="approve_borrow.php" method="POST"
              style="display:inline;">

            <input
                type="hidden"
                name="borrow_id"
                value="<?php echo $row['borrow_id']; ?>"
            >

            <button class="approve" type="submit" name="approve">
                Approve
            </button>

        </form>


        <form action="reject_borrow.php" method="POST"
              style="display:inline;">

            <input
                type="hidden"
                name="borrow_id"
                value="<?php echo $row['borrow_id']; ?>"
            >

            <button class="reject" type="submit" name="reject">
                Reject
            </button>

        </form>

    </td>

</tr>

<?php

    }

} else {

?>

<tr>

    <td colspan="6" style="text-align:center;">
        No pending borrow requests.
    </td>

</tr>

<?php

}

?>

</table>

</div>

</div>

<div id="man">
    <a href="dashboard.php" class="back">
                        ← Back
                    </a>
</div>
</body>

</html>
