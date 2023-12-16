<?php
$pageTitle = "Logowanie...";
include __DIR__ . '/global/section/header.php';
?>

<?php
require __DIR__ . '/global/global-db/db_config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pobranie danych z formularza
$username = $_POST['username'];
$password = $_POST['password'];

// Zapytanie do bazy danych w celu sprawdzenia danych logowania administratora
$sql = "SELECT * FROM users WHERE username='$username' AND is_admin=1 AND admin_password=MD5('$password')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Poprawne logowanie
    session_start();
    $_SESSION['admin_username'] = $username;
    $_SESSION['isLogged'] = true;
    header("Location: UbWxNj19Zva2.php");
} else {
    // Nieprawidłowe dane logowania
    include __DIR__ . '/global/section/not-available.html';
}

$conn->close();
?>
