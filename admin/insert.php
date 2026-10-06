<?php
include('../connection.php');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $book_id = trim($_POST['book_id'] ?? '');
    $book_name = trim($_POST['book_name'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $ISBN = trim($_POST['ISBN'] ?? '');
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    if (
        $book_id === '' ||
        $book_name === '' ||
        $author === '' ||
        $ISBN === '' ||
        $quantity === false ||
        $quantity === null ||
        $quantity < 0
    ) {

        $error = 'Enter all book details and a valid non-negative quantity.';

    } else {

        $statement = mysqli_prepare(
            $connection,
            'INSERT INTO book (book_id, book_name, author, ISBN, quantity)
             VALUES (?, ?, ?, ?, ?)'
        );

        if ($statement) {

            mysqli_stmt_bind_param(
                $statement,
                'ssssi',
                $book_id,
                $book_name,
                $author,
                $ISBN,
                $quantity
            );

            if (mysqli_stmt_execute($statement)) {

                $success = 'Book added successfully.';

            } else {

                $error = 'Could not add the book. Check that the book ID and ISBN are not already in use.';
            }

            mysqli_stmt_close($statement);

        } else {

            $error = 'Could not prepare the book record.';
        }
    }
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

    <title>Add Book | Library Dashboard</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
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
            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px;
        }

        /* ================= PAGE ================= */

        .page {
            width: 100%;
            max-width: 850px;
        }

        /* ================= HEADER ================= */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 20px;
        }

        .page-header h1 {
            font-size: 28px;
            color: #0d4134;
        }

        .page-header p {
            color: #777;
            margin-top: 5px;
            font-size: 14px;
        }

        .back-link {
            text-decoration: none;
            background: #ffffff;
            color: #0d4134;

            padding: 11px 17px;

            border-radius: 10px;

            font-weight: 600;

            box-shadow: 0 3px 12px rgba(0,0,0,0.06);

            transition: 0.3s;
        }

        .back-link:hover {
            background: #0d4134;
            color: white;
        }

        /* ================= FORM CARD ================= */

        .form-card {
            background: white;

            border-radius: 18px;

            padding: 35px;

            box-shadow:
                0 8px 25px rgba(0,0,0,0.07);
        }

        .form-title {
            margin-bottom: 25px;

            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-icon {
            width: 48px;
            height: 48px;

            background: #dff5f1;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 23px;
        }

        .form-title h2 {
            font-size: 21px;
        }

        .form-title p {
            color: #777;
            font-size: 13px;
            margin-top: 4px;
        }

        /* ================= MESSAGES ================= */

        .message {
            padding: 13px 16px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-size: 14px;
        }

        .error {
            background: #ffe8e8;
            color: #c0392b;

            border: 1px solid #ffcaca;
        }

        .success {
            background: #e4f8ee;
            color: #198754;

            border: 1px solid #bce8d0;
        }

        /* ================= FORM GRID ================= */

        .form-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 14px;

            font-weight: 600;

            margin-bottom: 8px;

            color: #0d4134;
        }

        input {
            width: 100%;

            height: 48px;

            padding: 0 14px;

            border: 1px solid #d8dfdd;

            border-radius: 10px;

            outline: none;

            font-size: 14px;

            color: #333;

            background: #fafcfc;

            transition: 0.25s;
        }

        input:focus {
            border-color: #0d4134;

            background: white;

            box-shadow:
                0 0 0 3px rgba(13,65,52,0.08);
        }

        input::placeholder {
            color: #aaa;
        }

        /* ================= BUTTON ================= */

        .form-actions {
            margin-top: 28px;

            display: flex;

            justify-content: flex-end;

            gap: 12px;
        }

        .cancel-btn,
        .save-btn {
            border: none;

            padding: 13px 22px;

            border-radius: 10px;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            text-decoration: none;

            transition: 0.3s;
        }

        .cancel-btn {
            background: #f0f2f2;
            color: #555;
        }

        .cancel-btn:hover {
            background: #e2e5e5;
        }

        .save-btn {
            background: #0d4134;
            color: white;
        }

        .save-btn:hover {
            background: #176b57;

            transform: translateY(-1px);
        }

        /* ================= MOBILE ================= */

        @media (max-width: 650px) {

            body {
                padding: 15px;
                align-items: flex-start;
            }

            .page {
                margin-top: 10px;
            }

            .page-header {
                align-items: flex-start;
                gap: 15px;
            }

            .page-header h1 {
                font-size: 23px;
            }

            .back-link {
                font-size: 13px;
                padding: 9px 12px;
            }

            .form-card {
                padding: 22px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column;
            }

            .save-btn,
            .cancel-btn {
                width: 100%;
                text-align: center;
            }
        }

    </style>

</head>

<body>

<div class="page">

    <!-- ================= HEADER ================= -->

    <div class="page-header">

        <div>
            <h1>Add Book</h1>

            <p>
                Add a new book to your library collection.
            </p>
        </div>

        <a href="dashboard.php" class="back-link">
            ← Back
        </a>

    </div>


    <!-- ================= FORM ================= -->

    <div class="form-card">

        <div class="form-title">

            <div class="form-icon">
                📚
            </div>

            <div>
                <h2>Book Information</h2>

                <p>
                    Enter the details of the book below.
                </p>
            </div>

        </div>


        <!-- ERROR -->

        <?php if ($error !== ''): ?>

            <div class="message error" role="alert">

                ⚠️
                <?php
                echo htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    'UTF-8'
                );
                ?>

            </div>

        <?php endif; ?>


        <!-- SUCCESS -->

        <?php if ($success !== ''): ?>

            <div class="message success" role="status">

                ✓
                <?php
                echo htmlspecialchars(
                    $success,
                    ENT_QUOTES,
                    'UTF-8'
                );
                ?>

            </div>

        <?php endif; ?>


        <form action="insert.php" method="POST">

            <div class="form-grid">

                <!-- BOOK ID -->

                <div class="form-group">

                    <label for="book_id">
                        Book ID
                    </label>

                    <input
                        id="book_id"
                        name="book_id"
                        type="text"
                        placeholder="e.g. BK001"
                        required
                        value="<?php
                        echo htmlspecialchars(
                            $_POST['book_id'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>"
                    >

                </div>


                <!-- TITLE -->

                <div class="form-group">

                    <label for="book_name">
                        Book Title
                    </label>

                    <input
                        id="book_name"
                        name="book_name"
                        type="text"
                        placeholder="Enter book title"
                        required
                        value="<?php
                        echo htmlspecialchars(
                            $_POST['book_name'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>"
                    >

                </div>


                <!-- AUTHOR -->

                <div class="form-group">

                    <label for="author">
                        Author
                    </label>

                    <input
                        id="author"
                        name="author"
                        type="text"
                        placeholder="Enter author's name"
                        required
                        value="<?php
                        echo htmlspecialchars(
                            $_POST['author'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>"
                    >

                </div>


                <!-- ISBN -->

                <div class="form-group">

                    <label for="ISBN">
                        ISBN
                    </label>

                    <input
                        id="ISBN"
                        name="ISBN"
                        type="text"
                        placeholder="Enter ISBN number"
                        required
                        value="<?php
                        echo htmlspecialchars(
                            $_POST['ISBN'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>"
                    >

                </div>


                <!-- QUANTITY -->

                <div class="form-group">

                    <label for="quantity">
                        Quantity
                    </label>

                    <input
                        id="quantity"
                        name="quantity"
                        type="number"
                        min="0"
                        placeholder="Enter quantity"
                        required
                        value="<?php
                        echo htmlspecialchars(
                            $_POST['quantity'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        );
                        ?>"
                    >

                </div>

            </div>


            <!-- ACTIONS -->

            <div class="form-actions">

                <a
                    href="admin_insert.php"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="save-btn"
                >
                    + Save Book
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>
