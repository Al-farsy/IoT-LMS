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

    <title>Delete Books | Library Dashboard</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        body {

            /* background: #f4f7f6; */
                    background:
    linear-gradient(
      45deg,
      rgba(175, 201, 29, 0.1) 5%,
      rgba(71, 230, 182, 0.36) 10%
    ),
    linear-gradient(
      90deg,
      rgba(78, 92, 151, 0.56) 10%,
      rgba(228, 225, 224, 0.55) 60%
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


        .back-btn {

            text-decoration: none;

            background: white;

            color: #0d4134;

            padding: 11px 18px;

            border-radius: 10px;

            font-size: 14px;

            font-weight: 600;

            box-shadow:
                0 3px 12px rgba(0,0,0,0.06);

            transition: 0.3s;
        }


        .back-btn:hover {

            background: #0d4134;

            color: white;
        }


        /* ================= TABLE CARD ================= */

        .table-card {

            background: white;

            border-radius: 18px;

            padding: 25px;

            box-shadow:
                0 7px 25px rgba(0,0,0,0.06);
        }


        .table-top {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;
        }


        .table-top h2 {

            color: #0d4134;

            font-size: 20px;
        }


        .table-top span {

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

            min-width: 800px;

            border-collapse: collapse;
        }


        thead {

            background: #0d4134;
        }


        th {

            color: white;

            padding: 15px;

            text-align: left;

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

            background: #fff7f7;
        }


        tbody tr:last-child td {

            border-bottom: none;
        }


        /* ================= BOOK TITLE ================= */

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


        /* ================= DELETE BUTTON ================= */

        .delete-btn {

            border: none;

            background: #ffe5e5;

            color: #d63031;

            padding: 9px 15px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 13px;

            font-weight: 600;

            transition: 0.3s;
        }


        .delete-btn:hover {

            background: #d63031;

            color: white;
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


            .back-btn {

                padding: 9px 12px;

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

            <h1>Delete Books</h1>

            <p>
                Manage books and remove unwanted records.
            </p>

        </div>


        <a
            href="dashboard.php"
            class="back-btn"
        >
            ← Back
        </a>

    </div>


    <!-- ================= TABLE ================= -->

    <div class="table-card">


        <div class="table-top">

            <h2>📚 Books List</h2>

            <span>
                Select a book to remove
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

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>


                <?php

                if (mysqli_num_rows($query) > 0) {

                    while ($row = mysqli_fetch_assoc($query)) {

                ?>


                    <tr>


                        <!-- BOOK ID -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['book_id'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <!-- TITLE -->

                        <td class="book-title">

                            <?php
                            echo htmlspecialchars(
                                $row['book_name'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <!-- AUTHOR -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['author'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <!-- CREATED -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['created_at'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>

                        </td>


                        <!-- ISBN -->

                        <td>

                            <?php
                            echo htmlspecialchars(  $row['ISBN'],  ENT_QUOTES, 'UTF-8' );
                            ?>

                        </td>

                        <td>
                            <span class="quantity">

                                <?php
                                echo htmlspecialchars(    $row['quantity'],    ENT_QUOTES,    'UTF-8'  );
                                ?>
                            </span>
                        </td>

                        <td>
                            <form
                                action="delete.php"
                                method="POST" >
                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php
                                    echo htmlspecialchars(
                                        $row['book_id'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                    ?>" >
                                <button
                                    type="submit"
                                    name="delete"
                                    class="delete-btn">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                    }

                } else {
                ?>

                    <tr>
                        <td
                            colspan="7"
                            class="empty"  >
                            📚 No books found in the library.
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
