<?php

include('../connection.php');

$sql = "SELECT * FROM book";

$query = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Books List</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        body {

            /* background: #f4f7f6; */
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

            padding: 30px;
        }


        /* ================= PAGE ================= */

        .page {

            max-width: 1200px;

            margin: auto;
        }


        /* ================= HEADER ================= */

        .page-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 25px;
        }


        .page-header h1 {

            color: #0d4134;

            font-size: 28px;

            margin-bottom: 6px;
        }


        .page-header p {

            color: #777;

            font-size: 14px;
        }


        /* ================= ADD BUTTON ================= */

        .add-btn {

            text-decoration: none;

            background: #0d4134;

            color: white;

            padding: 12px 18px;

            border-radius: 10px;

            font-size: 14px;

            font-weight: 600;

            transition: 0.3s;
        }


        .add-btn:hover {

            background: #176b57;

            transform: translateY(-1px);
        }


        /* ================= TABLE CARD ================= */

        .table-card {

            background: white;

            border-radius: 18px;

            padding: 25px;

            box-shadow:
                0 7px 25px rgba(0,0,0,0.06);
        }


        .table-header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }


        .table-header h2 {

            color: #0d4134;

            font-size: 20px;
        }


        .table-header span {

            color: #777;

            font-size: 13px;
        }


        /* ================= TABLE ================= */

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

            background: #0d4134;
        }


        th {

            color: white;

            text-align: left;

            padding: 15px;

            font-size: 14px;

            font-weight: 600;
        }


        td {

            padding: 15px;

            border-bottom: 1px solid #eeeeee;

            color: #444;

            font-size: 14px;
        }


        tbody tr {

            transition: 0.2s;
        }


        tbody tr:hover {

            background: #f4faf8;
        }


        tbody tr:last-child td {

            border-bottom: none;
        }


        /* ================= TITLE ================= */

        .book-title {

            color: #0d4134;

            font-weight: 600;
        }


        /* ================= QUANTITY ================= */

        .quantity {

            display: inline-block;

            background: #dff5f1;

            color: #0d4134;

            padding: 6px 12px;

            border-radius: 20px;

            font-weight: 600;

            font-size: 13px;
        }


        /* ================= EMPTY ================= */

        .empty {

            text-align: center;

            padding: 40px;

            color: #777;
        }


        /* ================= MOBILE ================= */

        @media (max-width: 650px) {

            body {

                padding: 15px;
            }


            .page-header {

                align-items: flex-start;

                gap: 15px;
            }


            .page-header h1 {

                font-size: 23px;
            }


            .add-btn {

                padding: 10px 13px;

                font-size: 13px;
            }


            .table-card {

                padding: 15px;
            }

        }

    </style>

</head>


<body>


<div class="page">


    <!-- ================= HEADER ================= -->

    <div class="page-header">

        <div>

            <h1>Books List</h1>

            <p>
                View all books available in the library.
            </p>

        </div>


        <a
            href="insert.php"
            class="add-btn"
        >
            + Add Book
        </a>

    </div>


    <!-- ================= TABLE ================= -->

    <div class="table-card">


        <div class="table-header">

            <h2>📚 Available Books</h2>

            <span>
                Library Collection
            </span>

        </div>


        <div class="table-wrapper">


            <table>


                <thead>

                    <tr>

                        <th>
                            Book ID
                        </th>

                        <th>
                            Title
                        </th>

                        <th>
                            Author
                        </th>

                        <th>
                            Created
                        </th>

                        <th>
                            ISBN
                        </th>

                        <th>
                            Quantity
                        </th>

                    </tr>

                </thead>


                <tbody>


                <?php

                if (mysqli_num_rows($query) > 0) {

                    while ($row = mysqli_fetch_assoc($query)) {

                ?>


                    <tr>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['book_id'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td class="book-title">

                            <?php
                            echo htmlspecialchars(
                                $row['book_name'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['author'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['created_at'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['ISBN'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <td>

                            <span class="quantity">

                                <?php
                                echo htmlspecialchars(
                                    $row['quantity'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>

                            </span>

                        </td>


                    </tr>


                <?php

                    }

                } else {

                ?>


                    <tr>

                        <td
                            colspan="6"
                            class="empty"
                        >
                            📚 No books available.
                        </td>

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
