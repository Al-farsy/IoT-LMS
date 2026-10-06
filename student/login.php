<?php
session_start();
include('../connection.php');

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'";

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == "student") {
            header("Location: ../student/dashboard.php");
            exit();
        } elseif ($user['role'] == "admin") {
            header("Location: ../admin/dashboard.php");
            exit();
        }
    } else {
        $message = "Email or password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0" >
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
             background-image:url(../images/far.jpeg);
             background-size:cover;
        }
        .login-box {
            width: 350px;
            background:rgba(158, 158, 157, 0.53);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px #17638f;
        }
        h1 {
            text-align: center;
            color: #0d4134;
        }
        label {
            color: #333;
        }
        input {
            width: 100%;
            padding: 11px;
            margin: 8px 0 18px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #0d4134;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #176b57;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
<div class="login-box">
    <h1>Login</h1>
    <?php
    if ($message != "") {
        echo "<p class='error'>$message</p>";
    }
    ?>
    <form method="POST">

        <label>Email</label>
   <input   type="email" name="email"  required>

        <label>Password</label>
        <input  type="password" name="password" required>

        <button type="submit"  name="login"> Login    </button>
    </form>

</div>
</body>
</html>