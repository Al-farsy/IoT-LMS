<?php
session_start();
include('../connection.php');
// Check if student is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $registration_number = $_POST['registration_number'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE student SET
            name = '$name',
            registration_number = '$registration_number',
            gender = '$gender',
            course = '$course',
            email = '$email',
            phone = '$phone'
            WHERE user_id = '$user_id'";

    if (mysqli_query($connection, $sql)) {
        header("Location: profile.php");
        exit();
    } else {
        $error = "Failed to update profile: " . mysqli_error($connection);
    }
}


$sql = "SELECT * FROM student WHERE user_id = '$user_id'";
$result = mysqli_query($connection, $sql);
if (!$result) {
    die("Database error: " . mysqli_error($connection));
}

if (mysqli_num_rows($result) > 0) {
    $student = mysqli_fetch_assoc($result);
} else {
    echo "Student information not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }


        body {
            display: flex;
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


        /* SIDEBAR */

        .sidebar {
            width: 240px;
            height: 100vh;
            background: #0d4134;
            color: white;
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
            font-size: 25px;
        }


        .logo span {
            color: #38bdf8;
        }


        .nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }


        .nav a {
            text-decoration: none;
            color: white;
            padding: 14px 15px;
            border-radius: 8px;
            display: block;
        }


        .nav a:hover {
            background: #334155;
        }


        .nav .active {
            background: #0d4134;
        }


        .nav .logout {
            margin-top: 30px;
            background: #dc2626;
        }


        /* MAIN */

        .main {
            margin-left: 240px;
            width: calc(100% - 240px);
            min-height: 100vh;
            padding: 30px;
        }


        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }


        .topbar h1 {
            color: #1e293b;
        }


        .student {
            background: white;
            padding: 12px 20px;
            border-radius: 25px;
        }


        /* FORM */

        .form-card {
            background: white;
            max-width: 800px;
            margin: auto;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }


        .form-card h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #1e293b;
        }


        .form-group {
            margin-bottom: 20px;
        }


        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: bold;
        }


        .form-group input,
        .form-group select {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }


        .form-group input:focus,
        .form-group select:focus {
            border-color: #2563eb;
        }


        .buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }


        .update-btn {
            flex: 1;
            border: none;
            background: #0b754c;
            color: white;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }


        .update-btn:hover {
            background: #8d791f;
        }


        .cancel-btn {
            flex: 1;
            text-align: center;
            text-decoration: none;
            background: #e46545;
            color: white;
            padding: 14px;
            border-radius: 8px;
            font-weight: bold;
        }


        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
        }


        @media (max-width: 700px) {

            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                width: calc(100% - 200px);
                padding: 15px;
            }

            .buttons {
                flex-direction: column;
            }

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

        <a href="dashboard.php">
            🏠 Dashboard
        </a>


        <a href="profile.php" class="active">
            👤 Profile
        </a>


        <a href="borrow.php">
            📚 Borrowing
        </a>


        <a href="exit.php" class="logout">
            🚪 Logout
        </a>

    </nav>

</aside>



<!-- MAIN -->

<main class="main">


    <div class="topbar">

        <h1>Edit Profile</h1>

        <div class="student">
            🧑‍🎓 Student
        </div>

    </div>



    <div class="form-card">

        <h2>✏️ Update Your Information</h2>


        <?php

        if (isset($error)) {

            echo "<div class='error'>";
            echo htmlspecialchars($error);
            echo "</div>";

        }

        ?>


        <form method="POST">


            <!-- NAME -->

            <div class="form-group">

                <label>Full Name</label>

                <input
                    type="text"
                    name="name"
                    value="<?php echo htmlspecialchars($student['name']); ?>"
                    required
                >

            </div>



            <!-- REGISTRATION NUMBER -->

            <div class="form-group">

                <label>Registration Number</label>

                <input
                    type="text"
                    name="registration_number"
                    value="<?php echo htmlspecialchars($student['registration_number']); ?>"
                    required
                >

            </div>



            <!-- GENDER -->

            <div class="form-group">

                <label>Gender</label>

                <select name="gender" required>

                    <option value="Male"
                        <?php
                        if ($student['gender'] == 'Male') {
                            echo 'selected';
                        }
                        ?>>
                        Male
                    </option>


                    <option value="Female"
                        <?php
                        if ($student['gender'] == 'Female') {
                            echo 'selected';
                        }
                        ?>>
                        Female
                    </option>

                </select>

            </div>



            <!-- COURSE -->

            <div class="form-group">

                <label>Course</label>

                <input
                    type="text"
                    name="course"
                    value="<?php echo htmlspecialchars($student['course']); ?>"
                    required
                >

            </div>



            <!-- EMAIL -->

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($student['email']); ?>"
                    required
                >

            </div>



            <!-- PHONE -->

            <div class="form-group">

                <label>Phone Number</label>

                <input
                    type="text"
                    name="phone"
                    value="<?php echo htmlspecialchars($student['phone']); ?>"
                    required
                >

            </div>



            <!-- BUTTONS -->

            <div class="buttons">

                <a href="profile.php" class="cancel-btn">
                    Cancel
                </a>


                <button
                    type="submit"
                    name="update"
                    class="update-btn">
                    💾 Update Profile
                </button>

            </div>


        </form>

    </div>

</main>


</body>

</html>