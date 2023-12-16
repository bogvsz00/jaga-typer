<?php
include __DIR__ . '/global/section/header.php';
?>

<?php
// submit_picks.php

require __DIR__ . '/global/global-db/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $selectedRound = $_POST['selected_round'];
    $username = $_POST['username'];
    $matchIds = $_POST['match_id'];
    $results1 = $_POST['result1'];
    $results2 = $_POST['result2'];
    $jagielloniaPlayers = $_POST['jagiellonia_players'];

    // Sprawdzenie, czy użytkownik już istnieje
    $userId = getUserId($conn, $username);

    // Jeśli użytkownik nie istnieje, dodaj nowego
    if (!$userId) {
        $userId = addUser($conn, $username);
    }

    // Iteracja przez mecze i dodawanie wyborów do bazy danych
    foreach ($matchIds as $matchId) {
        $result1 = $results1[$matchId] ?? null;
        $result2 = $results2[$matchId] ?? null;
        $jagielloniaPlayer = $jagielloniaPlayers[$matchId] ?? null;

        // Sprawdź, czy wszystkie wymagane dane są dostępne
        if ($result1 !== null && $result2 !== null) {
            addPicks($conn, $userId, $matchId, $result1, $result2, $jagielloniaPlayer);
        }
    }

    // Przekierowanie po dodaniu obstawień
    include __DIR__ . '/global/section/success.html';
} else {
    // Jeśli formularz nie został przesłany, przekieruj na stronę główną
    header('Location: /');
}

$conn->close();

function getUserId($conn, $username) {
    $userCheckSql = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $userCheckSql->bind_param("s", $username);
    $userCheckSql->execute();
    $userCheckResult = $userCheckSql->get_result();

    return $userCheckResult->num_rows > 0 ? $userCheckResult->fetch_assoc()['id'] : null;
}

function addUser($conn, $username) {
    $userInsertSql = $conn->prepare("INSERT INTO users (username) VALUES (?)");
    $userInsertSql->bind_param("s", $username);
    $userInsertSql->execute();

    return $conn->insert_id;
}

function addPicks($conn, $userId, $matchId, $result1, $result2, $jagielloniaPlayer) {
    $insertPicksSql = $conn->prepare("INSERT INTO user_picks (user_id, match_id, pick_result1, pick_result2, jagiellonia_player_pick_id)
        VALUES (?, ?, ?, ?, ?)");
    $insertPicksSql->bind_param("iiiii", $userId, $matchId, $result1, $result2, $jagielloniaPlayer);
    $insertPicksSql->execute();
}
?>
