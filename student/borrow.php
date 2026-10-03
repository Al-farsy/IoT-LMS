<?php
include('../connection.php');
// Kuchukua vitabu
$sql = "SELECT * FROM book";
$result = mysqli_query($connection, $sql);
// Kuhesabu quantity ya vitabu vyote
$count_sql = "SELECT SUM(quantity) AS total_books FROM book";
$count_result = mysqli_query($connection, $count_sql);
$count = mysqli_fetch_assoc($count_result);
$total_books = $count['total_books'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Borrow Books</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
           background:
    linear-gradient(
      45deg,
      rgba(201, 83, 29, 0.2) 0%,
      rgba(91, 126, 9, 0.36) 10%
    ),
    linear-gradient(
      90deg,
      rgba(14, 92, 24, 0.66) 60%,
      rgba(223, 93, 33, 0.55) 90%
    );
            color: #0d4134;
        }
            .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background-color: #0d4134;
            padding: 25px 18px;
        }
        .logo {
            text-align: center;
            margin-bottom: 35px;
        }
        .logo h2 {
            color: white;
            font-size: 25px;
        }
        .logo span {
            color: yellow;
        }
        .nav {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .nav a {
            text-decoration: none;
            color: white;
            padding: 14px 16px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            transition: 0.3s;
        }
        .nav a:hover {
       background-color: #176b57;
        }
        .nav a.active {
            background-color: white;
           color: #0d4134;
        }
        .nav a.logout {
            margin-top: 25px;
            background-color: #d63031;
        }
        .main {
            margin-left: 240px;
            padding: 30px;
        }
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .top h1 {
            font-size: 28px;
           color: #0d4134;
        }
        .student {
            background-color: white;
            padding: 10px 18px;
            border-radius: 25px;
            font-weight: bold;
            box-shadow:
                0 3px 12px rgba(0,0,0,0.06);
        }
        .book-count {
            width: 260px;
            background-color: #0d4134;
            color: white;
            padding: 22px;
            border-radius: 16px;
            margin-bottom: 25px;
        }
        .book-count p {
            color: #d9f2ec;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .book-count h2 {
            font-size: 32px;
        }
        .table-card {
            background-color: white;
            padding: 25px;
            border-radius: 18px;
            box-shadow:
                0 6px 20px rgba(0,0,0,0.06);
        }
        .table-header {
            margin-bottom: 20px;
        }
        .table-header h2 {
            font-size: 21px;
            margin-bottom: 6px;
        }
        .table-header p {
            color: #777;
            font-size: 14px;
        }
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            min-width: 750px;
            border-collapse: collapse;
        }
        thead {
            background-color: #0d4134;
        }
        th {
            color: white;
            text-align: left;
            padding: 15px;
            font-size: 14px;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #eeeeee;
            color: #444;
            font-size: 14px;
        }
        tbody tr:hover {
            background-color: #f4faf8;
        }
        .title {
            color: #0d4134;
            font-weight: bold;
        }
        .quantity {
            background-color: #dff5f1;
            color: #0d4134;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
        }
        .empty {
            background-color: #ffe5e5;
            color: #d63031;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }
        .borrow-btn {
            background-color: #0d4134;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .borrow-btn:hover {
            background-color: #176b57;
        }
        .disabled-btn {
            background-color: #cccccc;
            color: #666;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            cursor: not-allowed;
        }
        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .main {
                margin-left: 0;
                padding: 15px;
            }
            .top {
                align-items: flex-start;
                gap: 15px;
            }
            .top h1 {
                font-size: 22px;
            }
            .book-count {
                width: 100%;
            }
            .table-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo">
        <h2>     Library<span>.</span></h2>
    </div>
    <div class="nav">
        <a href="dashboard.php">   🏠 Dashboard </a>
        <a href="profile.php"> 👤 Profile</a>
        <a  href="borrow.php"class="active">📚 Borrowing </a>
        <a href="exit.php"class="logout">🚪 Logout </a>
    </div>
</div>
<div class="main">
    <div class="top">
        <h1> Borrow Books </h1>
        <div class="student">   🧑‍🎓 Student</div>
    </div>
    <div class="book-count">
        <p>Available Books</p>
        <h2><?php echo $total_books; ?></h2>
    </div>
    <div class="table-card">
        <div class="table-header">
            <h2>    📚 Books List</h2>
            <p>Select a book you want to borrow.  </p>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>    Book ID</th>
                        <th> Title </th>
                        <th>   Author   </th>
                        <th>ISBN </th>
                        <th>   Available     </th>
                        <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($book = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td>
                            <?php
                            echo $book['book_id'];
                            ?>
                        </td>
                        <td class="title">
                            <?php
                            echo $book['book_name'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $book['author'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $book['ISBN'];
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($book['quantity'] > 0) {
                            ?>
                                <span class="quantity">
                                    <?php
                                    echo $book['quantity'];
                                    ?>
                                </span>
                            <?php
                            } else {
                            ?>
                              <span class="empty">  Not Available </span>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($book['quantity'] > 0) {
                            ?>

                                <form action="borrow_request.php"method="POST" >
            <input type="hidden" name="book_id"  value="<?php  echo $book['book_id'];   ?>">
       <button
     type="submit"  name="borrow" class="borrow-btn" >    Borrow   </button>
      </form>
                            <?php
                            } else {
                            ?>
                                <button class="disabled-btn" disabled> Not Available</button>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td
                            colspan="6"
                            style="
         text-align:center;   padding:40px;color:#777; " > 📚 No books found.</td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>