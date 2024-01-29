<?php
$pageTitle = "Usuwanie meczu";
include __DIR__ . '/global/section/header.php';
require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['match_id'])) {
        $matchId = $_POST['match_id'];

        // Zapytanie SQL do usunięcia meczu
        $sqlRemoveMatch = "DELETE FROM matches WHERE id = '$matchId'";
        $resultRemoveMatch = $conn->query($sqlRemoveMatch);

        if ($resultRemoveMatch) {
            echo "Mecz o ID $matchId został usunięty.";
        } else {
            echo "Błąd podczas usuwania meczu: " . $conn->error;
        }
    } else {
        echo "Nieprawidłowe żądanie.";
    }

    // Zamknięcie połączenia
    $conn->close();
} else {
    include __DIR__ . '/global/section/not-available.html';
}
?>

<?php
include __DIR__ . '/global/section/footer.php';
?>

</html>