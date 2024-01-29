<?php
require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $team1 = $_POST['team1'];
        $team2 = $_POST['team2'];
        $result1 = isset($_POST['result1']) ? $_POST['result1'] : 'NULL';
        $result2 = isset($_POST['result2']) ? $_POST['result2'] : 'NULL';
        $matchRound = $_POST['match_round'];
        $matchDate = $_POST['match_date'];
        $isJagiellonia = $_POST['is_jagiellonia'];

        // Prepared statements
        $stmt = $conn->prepare("INSERT INTO matches (team1, team2, result1, result2, match_round, match_date, is_jagiellonia) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiissi", $team1, $team2, $result1, $result2, $matchRound, $matchDate, $isJagiellonia);

        if ($stmt->execute()) {
            header("Location: admin_panel.php");
        } else {
            echo "Błąd podczas dodawania meczu: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    include __DIR__ . '/global/section/not-available.html';
}
