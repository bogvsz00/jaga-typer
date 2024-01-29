<?php
$pageTitle = "Aktualna kolejka Ekstraklasy";
include __DIR__ . '/global/section/header.php';
require __DIR__ . '/global/global-db/db_config.php';

// Pobieranie aktualnej rundy z bazy danych
$sqlSettings = "SELECT current_round FROM admin_settings";
$resultSettings = $conn->query($sqlSettings);

if ($resultSettings->num_rows > 0) {
    $rowSettings = $resultSettings->fetch_assoc();
    $currentRound = $rowSettings['current_round'];
} else {
    $currentRound = '1';
}

?>

<body id="index-body">
    <div class="container-index">
        <div class="header-typer">
            <img src=".\src\image\Herb_Jagielloni.png" alt="a" width="40px" style="vertical-align: -6px;">
            <h1 style="display: inline-block;">Typer</h1>
        </div>
        <h2 class="season-header">Sezon 24/25</h2>
        <div class="nav" style='margin-top: 15px'>
            <a href="leaderboards.php">
                <button class="leaderboard-button semi-red-button"><i class="fas fa-trophy"></i>&nbsp;&nbsp;Tabela wyników</button>
            </a>
        </div>
        <br>
        <div class="round-header" style='margin-bottom: 15px;'>
            <span class="brand-secondary red-opacity"><b><?php echo $currentRound ?></b></span>. kolejka Ekstraklasy
        </div>

        <div class="bet-panel">
            <?php

            $sql = "SELECT * FROM matches WHERE match_date > NOW() and match_round = $currentRound";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                session_start();

                echo "<form method='post' action='submit_picks.php'>";
                echo "<input type='hidden' name='selected_round' value='$currentRound'>";
                echo "<div class='adnt-container'>";
                echo "<i class='far fa-question-circle fa-xs adnotation-icon'></i>";
                echo "<span class='adnt-brand-text'>Wprowadź tutaj nazwę, która ma za każdym razem wyświetlać się w tabeli wyników</span>";
                echo "</div>";
                echo "<label class='user-label'><i class='fas fa-user fa-xs' style='margin-right: 7px;'></i>&nbsp;Nazwa gracza: <input class='username-input' type='text' name='username' required></label><br>";
                echo "<table>";
                echo "<tr><th class='match-th'>Mecz</th><th>Wynik (D)</th><th>Wynik (W)</th><th>Zawodnik Jagiellonii</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['team1']} - {$row['team2']}</td>";
                    echo "<td><input type='number' class='score-input' name='result1[{$row['id']}]' max='10' min='0' required></td>";
                    echo "<td><input type='number' class='score-input' name='result2[{$row['id']}]' max='10' min='0' required></td>";

                    if (strpos($row['team1'], 'Jagiellonia') !== false || strpos($row['team2'], 'Jagiellonia') !== false) {
                        echo "<td><select class='player-pick' name='jagiellonia_players[{$row['id']}]' required>";

                        $playersSql = "SELECT id, name, surname FROM jagiellonia_players";
                        $playersResult = $conn->query($playersSql);
                        while ($playerRow = $playersResult->fetch_assoc()) {
                            echo "<option value='{$playerRow['id']}'>{$playerRow['name']} {$playerRow['surname']}</option>";
                        }
                        echo "</select></td>";
                    } else {
                        echo "<td></td>";
                    }

                    echo "<input type='hidden' name='match_id[]' value='{$row['id']}'>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "<div class='form-buttons'>";
                echo "<input class='submit-button a-button' type='submit' value='Zatwierdź obstawienia'>";
                echo "<input class='reset-button a-button' type='reset' value='Zresetuj'>";
                echo "</div>";
                echo "</form>";
            } else {
                include __DIR__ . '/global/section/not-available.html';
            }

            $conn->close();
            ?>
        </div>
        <div class="leaderboard-panel">

        </div>
    </div>
    <link rel="stylesheet" href="style.css">
    <?php
    include __DIR__ . '/global/section/footer.php';
    ?>
</body>
<style>
    .container-index {
        margin-top: 40px !important;
        width: 500px;
        padding: 15px;
        align-items: center;
        justify-content: center;
        margin: auto;
        height: 100%;
        display: flex;
        flex-direction: column;
        background-color: #f2f2f2;
        border-radius: 20px;
    }

    .bet-panel {
        width: 450px;
        align-items: center;
        justify-content: center;
        margin: auto;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    table {
        width: 80%;
    }

    #index-body {
        background-color: #c81d25;
        color: black;
    }

    .not-available {
        background-color: #1f1f1f;
        color: white;
        border-radius: 15px
    }

    footer {
        color: white;
        font-weight: 600;
        background-color: transparent;
    }

    footer a {
        color: white;
    }

    .go-back-button {
        display: none;
    }

    .semi-red-button {
        background-color: #f9dedf;
        color: #dc3f45;
    }

    .season-header {
        color: black;
        opacity: 75%;
    }

    .round-header {
        font-weight: 700;
    }

    .score-input {
        color: black;
        width: 55px;
    }

    .player-pick {
        width: 100px;
    }

    table {
        width: 100%;
        table-layout: auto;
        border-collapse: collapse;
        margin-top: -25px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        width: auto;
    }

    .adnt-brand-text {
        color: black;
        opacity: 70%
    }

    .user-label {
        font-weight: 600;
    }

    .red-opacity {
        color: #dc3f45;
    }

    input[type="text"] {
        color: black;
    }

    .sucess {
        background-color: white;
    }
</style>

</html>