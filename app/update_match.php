<div class="body-container">
    <?php

    $pageTitle = "Aktualizowanie meczu";
    include __DIR__ . '/global/section/header.php';
    require __DIR__ . '/global/global-db/db_config.php';

    session_start();
    $isLogged = $_SESSION['isLogged'];

    if ($isLogged == true) {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['match_id'])) {
            $matchId = $_POST['match_id'];
            $team1 = $_POST['team1'];
            $team2 = $_POST['team2'];
            $result1 = $_POST['result1'];
            $result2 = $_POST['result2'];
            $matchRound = $_POST['match_round'];
            $matchDate = $_POST['match_date'];
            $isJagiellonia = $_POST['is_jagiellonia'];
            $jagielloniaPlayer = ($_POST['is_jagiellonia'] == 1) ? $_POST['jagiellonia_player'] : null;
        
            // Zapytanie SQL do aktualizacji danych meczu
            $sqlUpdateMatch = "UPDATE matches SET
                team1 = '$team1',
                team2 = '$team2',
                result1 = '$result1',
                result2 = '$result2',
                match_round = '$matchRound',
                match_date = '$matchDate',
                is_jagiellonia = '$isJagiellonia',
                jagiellonia_player_id = " . (($jagielloniaPlayer !== null) ? "'$jagielloniaPlayer'" : "NULL") . "
                WHERE id = '$matchId'";

            $resultUpdateMatch = $conn->query($sqlUpdateMatch);

            if ($resultUpdateMatch) {
                echo "Dane meczu zostały zaktualizowane.";
            } else {
                echo "Błąd podczas aktualizacji danych meczu: " . $conn->error;
            }
        } else {
            echo "Nieprawidłowe żądanie.";
            include __DIR__ . '/global/section/not-available.html';
        }

        // Zamknięcie połączenia
        $conn->close();
    } else {
        include __DIR__ . '/global/section/not-available.html';
    }
    ?>
    <a href="admin_panel.php"><button class="primary-button">Powrót do panelu administratora</button></a>
</div>
<?php
include __DIR__ . '/global/section/footer.php';
?>

</body>
<style>
    .body-container {
        padding: 10px;
    }
</style>

</html>
