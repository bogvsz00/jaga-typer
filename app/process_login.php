<?php
$pageTitle = "Logowanie...";
include __DIR__ . '/global/section/header.php';
?>

<?php
require __DIR__ . '/global/global-db/db_config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND is_admin=1 AND admin_password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['admin_username'] = $username;
    $_SESSION['isLogged'] = true;
    header("Location: admin_panel.php");
} else {
    include __DIR__ . '/global/section/not-available.html';
}

$conn->close();
?>