<?php
include('../connection.php');
$error = "";
$success = "";
$book = null;
// Kupata Book ID
$book_id = $_POST['id'] ?? '';

// Kama user amebonyeza Save
if (isset($_POST['save'])) {

    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $ISBN = $_POST['ISBN'];
    $quantity = $_POST['quantity'];

    // Update book
    $sql = "UPDATE book SET
            book_name='$book_name',
            author='$author',
            ISBN='$ISBN',
            quantity='$quantity'
            WHERE book_id='$book_id'";

    if (mysqli_query($connection, $sql)) {

        $success = "Book updated successfully.";

    } else {

        $error = "Failed to update book.";
    }
}


// Kuchukua taarifa za book
$sql = "SELECT * FROM book WHERE book_id='$book_id'";

$result = mysqli_query($connection, $sql);


if (mysqli_num_rows($result) > 0) {

    $book = mysqli_fetch_assoc($result);

} else {

    $error = "Book not found.";
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

    <title>Update Book</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        body {

            background: #f4f7f6;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 30px;

            color: #0d4134;
        }


        /* ================= CONTAINER ================= */

        .container {

            width: 100%;

            max-width: 700px;
        }


        /* ================= HEADER ================= */

        .header {

            margin-bottom: 20px;
        }


        .header h1 {

            font-size: 28px;

            color: #0d4134;

            margin-bottom: 6px;
        }


        .header p {

            color: #777;

            font-size: 14px;
        }


        /* ================= CARD ================= */

        .card {

            background: white;

            padding: 30px;

            border-radius: 18px;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.07);
        }


        .card-title {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 25px;
        }


        .icon {

            width: 45px;

            height: 45px;

            background: #dff5f1;

            border-radius: 10px;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 22px;
        }


        .card-title h2 {

            font-size: 20px;

            color: #0d4134;
        }


        /* ================= MESSAGE ================= */

        .message {

            padding: 13px 15px;

            border-radius: 9px;

            margin-bottom: 20px;

            font-size: 14px;
        }


        .error {

            background: #ffe7e7;

            color: #c0392b;
        }


        .success {

            background: #e3f7ed;

            color: #198754;
        }


        /* ================= FORM ================= */

        .form-group {

            margin-bottom: 20px;
        }


        label {

            display: block;

            margin-bottom: 7px;

            font-size: 14px;

            font-weight: 600;

            color: #0d4134;
        }


        input {

            width: 100%;

            height: 46px;

            padding: 0 13px;

            border: 1px solid #d8dfdd;

            border-radius: 9px;

            outline: none;

            font-size: 14px;

            color: #333;

            background: #fafcfc;
        }


        input:focus {

            border-color: #0d4134;

            background: white;

            box-shadow:
                0 0 0 3px rgba(13, 65, 52, 0.08);
        }


        input:disabled {

            background: #eeeeee;

            color: #777;

            cursor: not-allowed;
        }


        /* ================= BUTTONS ================= */

        .buttons {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-top: 25px;

            gap: 12px;
        }


        .back {

            text-decoration: none;

            background: #eeeeee;

            color: #555;

            padding: 12px 20px;

            border-radius: 9px;

            font-size: 14px;

            font-weight: 600;
        }


        .back:hover {

            background: #dddddd;
        }


        .save {

            border: none;

            background: #0d4134;

            color: white;

            padding: 12px 22px;

            border-radius: 9px;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;
        }


        .save:hover {

            background: #176b57;
        }


        /* ================= MOBILE ================= */

        @media (max-width: 600px) {

            body {

                padding: 15px;

                align-items: flex-start;
            }


            .container {

                margin-top: 20px;
            }


            .card {

                padding: 20px;
            }


            .header h1 {

                font-size: 23px;
            }


            .buttons {

                flex-direction: column-reverse;
            }


            .save,
            .back {

                width: 100%;

                text-align: center;
            }

        }

    </style>

</head>


<body>


<div class="container">


    <!-- HEADER -->

    <div class="header">

        <h1>Update Book</h1>

        <p>
            Edit the information of the selected book.
        </p>

    </div>


    <!-- CARD -->

    <div class="card">


        <div class="card-title">

            <div class="icon">
                ✏️
            </div>

            <div>

                <h2>Book Information</h2>

            </div>

        </div>


        <!-- ERROR -->

        <?php if ($error != "") { ?>

            <div class="message error">

                ⚠️

                <?php
                echo htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    'UTF-8'
                );
                ?>

            </div>

        <?php } ?>


        <!-- SUCCESS -->

        <?php if ($success != "") { ?>

            <div class="message success">

                ✓

                <?php
                echo htmlspecialchars(
                    $success,
                    ENT_QUOTES,
                    'UTF-8'
                );
                ?>

            </div>

        <?php } ?>


        <?php if ($book) { ?>


        <form
            action="update.php"
            method="POST"
        >
        <form
    action="update.php"
    method="POST"
>

    <input
        type="hidden"
        name="id"
        value="<?php
        echo htmlspecialchars(
            $book['book_id'],
            ENT_QUOTES,
            'UTF-8'
        );
        ?>"
    >



            <!-- BOOK ID -->

            <div class="form-group">

                <label>
                    Book ID
                </label>

                <input
                    type="text"

                    value="<?php
                    echo htmlspecialchars(
                        $book['book_id'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>"
                    disabled
                >
            </div>

            <!-- BOOK NAME -->
            <div class="form-group">
                <label for="book_name">
                    Book Name
                </label>
                <input
                    type="text"
                    id="book_name"
                    name="book_name"
                    value="<?php
                    echo htmlspecialchars(
                        $book['book_name'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>"
                    required
                >
            </div>

            <!-- AUTHOR -->
            <div class="form-group">
                <label for="author">
                    Author
                </label>
                <input
                    type="text"
                    id="author"
                    name="author"
                    value="<?php
                    echo htmlspecialchars(
                        $book['author'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>"
                    required
                >
            </div>
            <!-- ISBN -->
            <div class="form-group">
                <label for="ISBN">
                    ISBN
                </label>
                <input
                    type="text"
                    id="ISBN"
                    name="ISBN"
                    value="<?php
                    echo htmlspecialchars(
                        $book['ISBN'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>"
                    required
                >
            </div>
            <!-- QUANTITY -->
            <div class="form-group">
                <label for="quantity">
                    Quantity
                </label>
                <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    value="<?php
                    echo htmlspecialchars(
                        $book['quantity'],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>"
                    min="0"
                    required
                >
            </div>
            <!-- BUTTONS -->
            <div class="buttons">
                <a
                    href="dashboard.php"
                    class="back"
                >
                    ← Back to Books
                </a>
                <button
                    type="submit"
                    name="save"
                    class="save"
                >
                    ✓ Save Changes
                </button>
            </div>
        </form>
        <?php } ?>
    </div>
</div>
</body>
</html>
