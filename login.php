<?php
session_start();

$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "travel";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: index.html");CD <FIeldset></FIeldset>
        } else {
            header("Location: login.html?error=Invalid credentials");
        }
    } else {
        header("Location: login.html?error=Account not found");
    }
}
?>
