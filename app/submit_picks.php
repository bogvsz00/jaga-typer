<?php
$pageTitle = 'Typowanie zakończone';
include __DIR__ . '/global/section/header.php';
?>

<?php
// submit_picks.php

require __DIR__ . '/global/global-db/db_config.php';

// Sprawdzanie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $selectedRound = $_POST['selected_round'];
    $username = $_POST['username'];
    $matchIds = $_POST['match_id'];
    $results1 = $_POST['result1'];
    $results2 = $_POST['result2'];
    $jagielloniaPlayers = $_POST['jagiellonia_players'];

    // Sprawdzenie, czy użytkownik już istnieje w bazie
    $userCheckSql = "SELECT id FROM users WHERE username = '$username'";
    $userCheckResult = $conn->query($userCheckSql);

    if ($userCheckResult->num_rows > 0) {
        // Użytkownik już istnieje - pobierz jego ID
        $userId = $userCheckResult->fetch_assoc()['id'];
    } else {
        // Użytkownik nie istnieje - dodaj nowego użytkownika
        $userInsertSql = "INSERT INTO users (username) VALUES ('$username')";
        $conn->query($userInsertSql);

        // Pobierz ID nowo dodanego użytkownika
        $userIdSql = "SELECT id FROM users WHERE username = '$username'";
        $userIdResult = $conn->query($userIdSql);
        $userId = $userIdResult->fetch_assoc()['id'];
    }

    // Iteracja przez mecze i dodawanie wyborów do bazy danych
    foreach ($matchIds as $key => $matchId) {
        $result1 = $results1[$key];
        $result2 = $results2[$key];
        $jagielloniaPlayer = $jagielloniaPlayers[$key] ?? null;

        $insertPicksSql = "INSERT INTO user_picks (user_id, match_id, pick_result1, pick_result2, jagiellonia_player_pick_id)
                           VALUES ($userId, $matchId, $result1, $result2, $jagielloniaPlayer)";
        $conn->query($insertPicksSql);
    }

    // Przekierowanie po dodaniu obstawień
    include __DIR__ . '/global/section/success.html';
} else {
    // Jeśli formularz nie został przesłany, przekieruj na stronę główną
    header('Location: /');
}

$conn->close();
?>
