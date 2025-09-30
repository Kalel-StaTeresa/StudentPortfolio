<?php
session_start();
require_once "db.php"; // database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        form {
            max-width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
        }
        .error { color: red; }
        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 8px;
            margin: 5px 0 10px 0;
        }
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Login</h2>

<form action="" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username"><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br>

    <input type="submit" value="Login">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "<p class='message error'>All fields are required!</p>";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM user_data WHERE username = :username AND password = :password LIMIT 1");
        $stmt->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            echo "<p class='message error'>Invalid Username or Password</p>";
        }
    }
}
?>

</body>
</html>
