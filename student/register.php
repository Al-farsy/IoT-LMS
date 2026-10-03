<?php
include('../connection.php');

$message = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == "student") {
        $registration_number = $_POST['registration_number'];
        $course = $_POST['course'];
        // Kuweka login details
        $sql = "INSERT INTO users (email, password, role)
                VALUES ('$email', '$password', '$role')";
        if (mysqli_query($connection, $sql)) {
            $user_id = mysqli_insert_id($connection);
            // Kuweka student details
            $sql = "INSERT INTO student
                    (name, registration_number, gender, course,
                     email, phone, password, user_id)
                    VALUES
                    ('$name', '$registration_number', '$gender',
                     '$course', '$email', '$phone',
                     '$password', '$user_id')";
            mysqli_query($connection, $sql);
            $message = "Student registered successfully.";
        }
    } else {
        // Kuweka login details
        $sql = "INSERT INTO users (email, password, role)
                VALUES ('$email', '$password', '$role')";
        if (mysqli_query($connection, $sql)) {
            $user_id = mysqli_insert_id($connection);
            // Kuweka admin details
            $sql = "INSERT INTO admin
                    (name, gender, email, phone, password, user_id)
                    VALUES
                    ('$name', '$gender', '$email',
                     '$phone', '$password', '$user_id')";
            mysqli_query($connection, $sql);
            $message = "Admin registered successfully.";
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
    <title>Register</title>
    <style>
        body {
            font-family: Arial;
            background-image:url(../images/far.jpeg);
            width: 100%;
            background-size:cover; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        form {
            width: 400px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px #ddd;
            background-color:rgba(138, 134, 134, 0.4);


        }
        h1 {
            color: #0d4134;
            text-align: center;
        }
        input,
        select {
            width: 100%;
            padding: 11px;
            margin: 7px 0 15px;
            box-sizing: border-box;
            border-radius:10px;
            border: none;
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
        .message {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>
<form method="POST">
    <h1>Register</h1>
    <?php
    if ($message != "") {
        echo "<p class='message'>$message</p>";
    }
?>

    <label>Role</label>
    <select name="role" id="role" onchange="showStudentFields()" required>
        <option value="">  Select Role</option>
        <option value="student"> Student</option>
        <option value="admin">      Admin   </option>
    </select>

    <label>Name</label>
    <input type="text" name="name" required>


    <div id="studentFields" style="display:none;">
        <label>Registration Number</label>
        <input    type="text"  name="registration_number">

        <label>Course</label>
        <input type="text" name="course">
    </div>

    <label>Gender</label>
    <select name="gender" required>
        <option value="">  Select Gender</option>
        <option value="Male">    Male</option>
        <option value="Female"> Female </option>
    </select>

    <label>Email</label>
    <input type="email" name="email"  required >

    <label>Phone</label>
    <input type="text" name="phone" required >

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit"name="register">Register</button>
</form>
<script>
function showStudentFields() {
    let role = document.getElementById("role").value;
    let fields = document.getElementById("studentFields");
    if (role == "student") {
        fields.style.display = "block";
    } else {
        fields.style.display = "none";
    }
}
</script>
</body>
</html>