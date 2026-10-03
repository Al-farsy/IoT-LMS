<?php

session_start();

include "../connection.php";


// Kupata student ID kutoka dashboard
if (!isset($_SESSION['student_id'])) {

    die("Student information not available.");

}

$student_id = $_SESSION['student_id'];


// Kupata taarifa za student
$sql = "SELECT *
        FROM student
        WHERE id='$student_id'";

$result = mysqli_query(
    $connection,
    $sql
);


if (!$result) {

    die("Database error: " . mysqli_error($connection));

}


if (mysqli_num_rows($result) > 0) {

    $student = mysqli_fetch_assoc($result);

} else {

    die("Student not found.");

}


// Kupata vitabu alivyokopa student
$sql_books = "SELECT
                book.book_name,
                book.author,
                borrow.borrow_date,
                borrow.status

              FROM borrow

              INNER JOIN book
              ON borrow.book_id = book.book_id

              WHERE borrow.student_id='$student_id'";


$result_books = mysqli_query(
    $connection,
    $sql_books
);


if (!$result_books) {

    die("Borrow books error: " . mysqli_error($connection));

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Student Profile</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        body {
            background: #f4f7f6;
            color: #0d4134;
            min-height: 100vh;
        }


        /* SIDEBAR */

        .sidebar {

            position: fixed;

            left: 0;
            top: 0;

            width: 240px;

            height: 100vh;

            background: #0d4134;

            padding: 25px 18px;
        }


        .logo {

            text-align: center;

            margin-bottom: 35px;
        }


        .logo h2 {

            color: white;

            font-size: 24px;
        }


        .logo span {

            color: #f1c40f;
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

            font-weight: 600;

            transition: 0.3s;
        }


        .nav a:hover {

            background: #176b57;

            transform: translateX(4px);
        }


        .nav a.active {

            background: white;

            color: #0d4134;
        }


        .nav a.logout {

            margin-top: 25px;

            background: #d63031;
        }


        .nav a.logout:hover {

            background: #b52b2c;

            transform: none;
        }


        /* MAIN */

        .main {

            margin-left: 240px;

            min-height: 100vh;

            padding: 30px 35px;
        }


        /* HEADER */

        .topbar {

            margin-bottom: 25px;
        }


        .topbar h1 {

            font-size: 28px;

            margin-bottom: 6px;
        }


        .topbar p {

            color: #777;

            font-size: 14px;
        }


        /* PROFILE */

        .profile-card {

            background: white;

            padding: 30px;

            border-radius: 18px;

            box-shadow:
                0 5px 18px rgba(0,0,0,0.06);

            margin-bottom: 25px;
        }


        .profile-title {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 25px;
        }


        .profile-icon {

            width: 50px;

            height: 50px;

            background: #dff5f1;

            border-radius: 50%;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 24px;
        }


        .profile-title h2 {

            font-size: 20px;
        }


        /* INFORMATION */

        .info {

            display: grid;

            grid-template-columns: 150px 1fr;

            padding: 14px 0;

            border-bottom: 1px solid #eeeeee;
        }


        .info:last-child {

            border-bottom: none;
        }


        .label {

            font-weight: 600;

            color: #555;
        }


        .value {

            color: #222;
        }


        /* BOOKS */

        .books-card {

            background: white;

            padding: 30px;

            border-radius: 18px;

            box-shadow:
                0 5px 18px rgba(0,0,0,0.06);
        }


        .books-card h2 {

            font-size: 20px;

            margin-bottom: 20px;
        }


        .table-wrapper {

            width: 100%;

            overflow-x: auto;
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

            font-size: 14px;
        }


        td {

            padding: 14px;

            border-bottom: 1px solid #eeeeee;

            color: #444;

            font-size: 14px;
        }


        .book-name {

            color: #0d4134;

            font-weight: 600;
        }


        .status {

            color: #198754;

            font-weight: 600;
        }


        .no-books {

            color: #777;

            font-size: 14px;
        }


        /* MOBILE */

        @media (max-width: 650px) {

            .sidebar {

                position: relative;

                width: 100%;

                height: auto;

                padding: 20px;
            }


            .logo {

                margin-bottom: 20px;
            }


            .nav {

                flex-direction: row;

                flex-wrap: wrap;
            }


            .nav a {

                padding: 10px 13px;

                font-size: 13px;
            }


            .nav a.logout {

                margin-top: 0;
            }


            .main {

                margin-left: 0;

                padding: 20px 15px;
            }


            .info {

                grid-template-columns: 1fr;

                gap: 6px;
            }


            .profile-card,
            .books-card {

                padding: 20px;
            }


            table {

                min-width: 600px;
            }

        }

    </style>

</head>


<body>


<!-- SIDEBAR -->

<aside class="sidebar">


    <div class="logo">

        <h2>
            Library<span>.</span>
        </h2>

    </div>


    <nav class="nav">


        <a href="dashboard.php">
            🏠 Dashboard
        </a>


        <a
            href="profile.php"
            class="active"
        >
            👤 Profile
        </a>


        <a href="borrow.php">
            📚 Borrowing
        </a>


        <a
            href="exit.php"
            class="logout"
        >
            🚪 Logout
        </a>


    </nav>

</aside>


<!-- MAIN -->

<main class="main">


    <!-- HEADER -->

    <div class="topbar">

        <h1>
            Student Profile
        </h1>

        <p>
            View your personal information and borrowed books.
        </p>

    </div>


    <!-- PERSONAL INFORMATION -->

    <section class="profile-card">


        <div class="profile-title">

            <div class="profile-icon">
                👤
            </div>


            <h2>
                Personal Information
            </h2>

        </div>


        <!-- NAME -->

        <div class="info">

            <div class="label">
                Name
            </div>


            <div class="value">

                <?php

                echo htmlspecialchars(
                    $student['name'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                ?>

            </div>

        </div>


        <!-- EMAIL -->

        <div class="info">

            <div class="label">
                Email
            </div>


            <div class="value">

                <?php

                echo htmlspecialchars(
                    $student['email'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                ?>

            </div>

        </div>


        <!-- COURSE -->

        <div class="info">

            <div class="label">
                Course
            </div>


            <div class="value">

                <?php

                echo htmlspecialchars(
                    $student['course'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                ?>

            </div>

        </div>


    </section>


    <!-- BORROWED BOOKS -->

    <section class="books-card">


        <h2>
            📚 Borrowed Books
        </h2>


        <?php

        if (mysqli_num_rows($result_books) > 0) {

        ?>


        <div class="table-wrapper">


            <table>

                <thead>

                    <tr>

                        <th>
                            Book Name
                        </th>

                        <th>
                            Author
                        </th>

                        <th>
                            Borrow Date
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody>


                <?php

                while (
                    $book =
                    mysqli_fetch_assoc($result_books)
                ) {

                ?>


                    <tr>

                        <td class="book-name">

                            <?php

                            echo htmlspecialchars(
                                $book['book_name'],
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $book['author'],
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            ?>

                        </td>


                        <td>

                            <?php

                            echo htmlspecialchars(
                                $book['borrow_date'],
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            ?>

                        </td>


                        <td class="status">

                            <?php

                            echo htmlspecialchars(
                                $book['status'],
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            ?>

                        </td>

                    </tr>


                <?php

                }

                ?>


                </tbody>

            </table>


        </div>


        <?php

        } else {

        ?>

            <p class="no-books">
                You have not borrowed any books.</p>
        <?php
        }
        ?>
    </section>
</main>
</body>
</html>