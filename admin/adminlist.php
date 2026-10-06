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

    <title>Update Books | Library Dashboard</title>

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
            font-size: 28px;
            color: #0d4134;
        }

        .page-header p {
            margin-top: 6px;
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

            box-shadow: 0 3px 12px rgba(0,0,0,0.06);

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

            overflow: hidden;
        }

        .table-top {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 20px;
        }

        .table-top h2 {
            font-size: 20px;
            color: #0d4134;
        }

        .table-top span {
            font-size: 13px;
            color: #777;
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

        /* ================= UPDATE BUTTON ================= */

        .update-btn {
            border: none;

            background: #0d4134;

            color: white;

            padding: 9px 16px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 13px;

            font-weight: 600;

            transition: 0.3s;
        }

        .update-btn:hover {
            background: #176b57;

            transform: translateY(-1px);
        }

        /* ================= EMPTY STATE ================= */

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

            <h1>Update Books</h1>

            <p>
                Manage and update information about books in your library.
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
                Manage your books
            </span>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Title</th>

                        <th>Author</th>

                        <th>Created</th>

                        <th>ISBN</th>

                        <th>Quantity</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $number = 1;

                if (mysqli_num_rows($query) > 0) {

                    while ($row = mysqli_fetch_assoc($query)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $number++; ?>
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

                        <td>

                            <form
                                action="update.php"
                                method="POST"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php
                                    echo htmlspecialchars(
                                        $row['book_id'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                    ?>"
                                >

                                <button
                                    type="submit"
                                    name="update"
                                    class="update-btn"
                                >
                                    ✏️ Update
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
                            class="empty"
                        >
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
