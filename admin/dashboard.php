
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            /* background: #f4f7f6; */
            color: #0d4134;
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
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
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
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            /* background: #ffffff; */
            border-right: 1px solid #e5e7eb;
            padding: 25px 18px;
            z-index: 1000;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo h2 {
            color: #0d4134;
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
            color: #0d4134;
            padding: 14px 16px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            transition: 0.3s;
        }

        .nav a:hover {
            background: #dff5f1;
            transform: translateX(4px);
        }

        .nav a.active {
            background: #0d4134;
            color: white;
        }

        .nav a.logout {
            margin-top: 25px;
            background: #ffe5e5;
            color: #d63031;
        }

        .nav a.logout:hover {
            background: #d63031;
            color: white;
        }

        /* ================= MAIN ================= */

        .main {
            margin-left: 240px;
            min-height: 100vh;
            padding: 25px 35px;
        }

        /* ================= TOP BAR ================= */

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .topbar h1 {
            color: #0d4134;
            font-size: 28px;
        }

        .admin {
            background: white;
            padding: 10px 18px;
            border-radius: 30px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            font-weight: 600;
        }

        /* ================= WELCOME ================= */

        .welcome {
            background: linear-gradient(
                135deg,
                #0d4134,
                #176b57
            );

            color: white;
            border-radius: 18px;
            padding: 28px;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(13,65,52,0.15);
        }

        .welcome h2 {
            margin-bottom: 8px;
            font-size: 23px;
        }

        .welcome p {
            color: #d9f2ec;
        }

        /* ================= CARDS ================= */

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card h3 {
            color: #777;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .card h2 {
            color: #0d4134;
            font-size: 28px;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            background: #dff5f1;
        }

        /* ================= TABLE ================= */

        .table-container {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            overflow-x: auto;
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

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        thead {
            background: #0d4134;
        }

        th {
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eeeeee;
            color: #444;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f4faf8;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .quantity {
            background: #dff5f1;
            color: #0d4134;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
        }

        .verified {
            color: #198754;
            font-weight: 600;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 900px) {

            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 1px solid #ddd;
            }

            .nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .nav a {
                padding: 10px 12px;
            }

            .nav a.logout {
                margin-top: 0;
            }

            .main {
                margin-left: 0;
                padding: 15px;
            }

            .topbar h1 {
                font-size: 22px;
            }

            .admin {
                font-size: 13px;
            }

            .welcome {
                padding: 20px;
            }

            .table-container {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<?php

include "../connection.php";

$sql = "SELECT * FROM book";
$result = mysqli_query($connection, $sql);

/* Count books */
$total_books = mysqli_num_rows($result);

?>

<!-- ================= SIDEBAR ================= -->

<aside class="sidebar">

    <div class="logo">
        <h2>Library<span>.</span></h2>
    </div>

    <nav class="nav">

        <a href="profile.php" class="active">
            👤 My Profile
        </a>

        <a href="insert.php">
            ➕ Add Books
        </a>

        <a href="admin_delete.php">
            🗑️ Remove Books
        </a>

        <a href="adminlist.php">
            ✏️ Update Details
        </a>

        <a href="borrow_request.php">
            📚 Borrow Requests
        </a>

        <a href="exit.php" class="logout">
            🚪 Logout
        </a>

    </nav>

</aside>


<!-- ================= MAIN CONTENT ================= -->

<main class="main">

    <!-- TOP BAR -->

    <div class="topbar">

        <h1>Admin Dashboard</h1>

        <div class="admin">
            🧑‍💼 Admin
        </div>

    </div>


    <!-- WELCOME -->

    <section class="welcome">

        <h2>Welcome back, Admin! 👋</h2>

        <p>
            Explore books and manage your library activities.
        </p>

    </section>


    <!-- ================= STATISTICS ================= -->

    <section class="cards">

        <div class="card">

            <div>
                <h3>Total Books</h3>
                <h2><?php echo $total_books; ?></h2>
            </div>

            <div class="card-icon">
                📚
            </div>

        </div>


        <div class="card">

            <div>
                <h3>Available Books</h3>
                <h2><?php echo $total_books; ?></h2>
            </div>

            <div class="card-icon">
                📖
            </div>

        </div>


        <div class="card">

            <div>
                <h3>Library Status</h3>
                <h2>Active</h2>
            </div>

            <div class="card-icon">
                ✅
            </div>

        </div>

    </section>


    <!-- ================= BOOK TABLE ================= -->

    <section class="table-container">

        <div class="table-header">

            <h2>📚 Books List</h2>

        </div>


        <table>

            <thead>

                <tr>

                    <th>#</th>

                    <th>Title</th>

                    <th>Author</th>

                    <th>Verified</th>

                    <th>ISBN</th>

                    <th>Quantity</th>

                </tr>

            </thead>


            <tbody>

            <?php

            $number = 1;

            while ($book = mysqli_fetch_assoc($result)) {

            ?>

                <tr>

                    <td>
                        <?php echo $number++; ?>
                    </td>

                    <td>
                        <strong>
                            <?php echo htmlspecialchars($book['book_name']); ?>
                        </strong>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($book['author']); ?>
                    </td>

                    <td class="verified">
                        ✓ <?php echo htmlspecialchars($book['created_at']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($book['ISBN']); ?>
                    </td>

                    <td>
                        <span class="quantity">
                            <?php echo htmlspecialchars($book['quantity']); ?>
                        </span>
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </section>

</main>

</body>
</html>
