<?php

session_start();

include("../connection.php");

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$error = "";
$success = "";


/* GET ADMIN DATA */

$sql = "SELECT * FROM admin WHERE user_id = ?";

$stmt = mysqli_prepare($connection, $sql);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$admin = mysqli_fetch_assoc($result);


if (!$admin) {
    die("Admin profile not found.");
}


/* UPDATE PROFILE */

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $registration_number = $_POST['registration_number'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


    $sql = "UPDATE admin SET
            name = ?,
            registration_number = ?,
            gender = ?,
            email = ?,
            phone = ?
            WHERE user_id = ?";


    $stmt = mysqli_prepare($connection, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $name,
        $registration_number,
        $gender,
        $email,
        $phone,
        $user_id
    );


    if (mysqli_stmt_execute($stmt)) {

        $success = "Profile updated successfully.";

        // Refresh data
        $sql = "SELECT * FROM admin WHERE user_id = ?";

        $stmt = mysqli_prepare($connection, $sql);

        mysqli_stmt_bind_param($stmt, "i", $user_id);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $admin = mysqli_fetch_assoc($result);

    } else {

        $error = "Failed to update profile.";

    }
}

?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Admin Profile</title>


<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f4f7f6;
}


/* SIDEBAR */

.sidebar {
    width: 240px;
    height: 100vh;
    background: #0d4134;
    position: fixed;
    left: 0;
    top: 0;
    padding: 25px 15px;
}

.logo {
    text-align: center;
    margin-bottom: 40px;
}

.logo h2 {
    color: white;
}

.logo span {
    color: #72d6bd;
}

.nav {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.nav a {
    text-decoration: none;
    color: white;
    padding: 14px;
    border-radius: 8px;
}

.nav a:hover,
.nav a.active {
    background: #176451;
}


/* MAIN */

.main {
    margin-left: 240px;
    min-height: 100vh;
}


/* TOPBAR */

.topbar {
    height: 75px;
    background: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 35px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.topbar h1 {
    color: #0d4134;
}

.admin {
    background: #dff5f1;
    color: #0d4134;
    padding: 10px 18px;
    border-radius: 20px;
    font-weight: bold;
}


/* FORM */

.container {
    padding: 40px;
}

.card {
    max-width: 800px;
    margin: auto;
    background: white;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.card h2 {
    color: #0d4134;
    margin-bottom: 25px;
}


/* MESSAGE */

.success {
    background: #dff5f1;
    color: #0d4134;
    padding: 12px;
    border-radius: 7px;
    margin-bottom: 20px;
}

.error {
    background: #ffe0e0;
    color: #b00000;
    padding: 12px;
    border-radius: 7px;
    margin-bottom: 20px;
}


/* FORM GROUP */

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #444;
    font-weight: bold;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 13px;
    border: 1px solid #ccc;
    border-radius: 7px;
    outline: none;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #0d4134;
}


/* BUTTONS */

.buttons {
    margin-top: 25px;
    display: flex;
    gap: 10px;
}

button,
.back {
    padding: 13px 25px;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    text-decoration: none;
    font-size: 15px;
}

button {
    background: #0d4134;
    color: white;
}

button:hover {
    background: #176451;
}

.back {
    background: #ddd;
    color: #333;
}

.back:hover {
    background: #ccc;
}

</style>

</head>


<body>


<!-- SIDEBAR -->

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

        <a href="exit.php">
            🚪 Logout
        </a>

    </nav>

</aside>


<!-- MAIN -->

<main class="main">


    <div class="topbar">

        <h1>Edit Profile</h1>

        <div class="admin">
            🧑‍💼 Admin
        </div>

    </div>


    <section class="container">


        <div class="card">

            <h2>✏️ Update Admin Profile</h2>


            <?php if ($success != "") { ?>

                <div class="success">
                    <?php echo $success; ?>
                </div>

            <?php } ?>


            <?php if ($error != "") { ?>

                <div class="error">
                    <?php echo $error; ?>
                </div>

            <?php } ?>


            <form method="POST">


                <!-- NAME -->

                <div class="form-group">

                    <label>Full Name</label>

                    <input
                        type="text"
                        name="name"
                        value="<?php echo htmlspecialchars($admin['name']); ?>"
                        required
                    >

                </div>


                <!-- REGISTRATION NUMBER -->

                <div class="form-group">

                    <label>Registration Number</label>

                    <input
                        type="text"
                        name="registration_number"
                        value="<?php echo htmlspecialchars($admin['registration_number'] ?? ''); ?>"
                    >

                </div>


                <!-- GENDER -->

                <div class="form-group">

                    <label>Gender</label>

                    <select name="gender">

                        <option value="">Select Gender</option>

                        <option value="Male"
                        <?php
                        if (($admin['gender'] ?? '') == 'Male')
                            echo 'selected';
                        ?>>
                            Male
                        </option>

                        <option value="Female"
                        <?php
                        if (($admin['gender'] ?? '') == 'Female')
                            echo 'selected';
                        ?>>
                            Female
                        </option>

                    </select>

                </div>


                <!-- EMAIL -->

                <div class="form-group">

                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        value="<?php echo htmlspecialchars($admin['email']); ?>"
                        required
                    >

                </div>


                <!-- PHONE -->

                <div class="form-group">

                    <label>Phone Number</label>

                    <input
                        type="text"
                        name="phone"
                        value="<?php echo htmlspecialchars($admin['phone'] ?? ''); ?>"
                    >

                </div>


                <!-- BUTTONS -->

                <div class="buttons">

                    <a href="profile.php" class="back">
                        ← Back
                    </a>

                    <button type="submit" name="update">
                        💾 Save Changes
                    </button>

                </div>


            </form>

        </div>

    </section>

</main>


</body>

</html>