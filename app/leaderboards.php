<?php
$pageTitle = "Tabele wyników";
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

        <h2 class="season-header">Tabela wyników</h2>
        <div class="nav" style='margin-top: 15px'>
            <a href="index.php">
                <button class="semi-red-button">Strona główna</button>
            </a>
        </div>
        <Br>

        <div class="toogle">
            <a href="leaderboards.php?table=klasyfikacja-ogolna">
                <button class="leaderboard-button semi-red-button"><i class="fas fa-trophy"></i>&nbsp;&nbsp;Klasyfikacja ogólna</button>
            </a>
            <a href="leaderboards.php?table=klasyfikacja-extra">
                <button class="leaderboard-button semi-red-button"><i class="fas fa-trophy"></i>&nbsp;&nbsp;Klasyfikacja Extra</button>
            </a>
        </div>
        <br>
        <div class="leaderboard-panel">

            <?php
            // Pobierz dane do tabeli wyników w zależności od wybranej klasyfikacji
            $selectedTable = isset($_GET['table']) ? $_GET['table'] : 'klasyfikacja-ogolna';

            $tableData = [];

            if ($selectedTable === 'klasyfikacja-ogolna') {
                $sql = "SELECT * FROM ogolna_table ORDER BY score_ogolna DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tableData[] = $row;
                    }
                }
            } elseif ($selectedTable === 'klasyfikacja-extra') {
                $sql = "SELECT * FROM extra_table ORDER BY score_extra DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tableData[] = $row;
                    }
                }
            }

            // Wyświetl tabelę wyników
            echo '<table>';
            echo '<tr><th>Pozycja</th><th>Nazwa gracza</th><th>Liczba punktów</th></tr>';

            $position = 1;
            foreach ($tableData as $row) {
                echo '<tr>';
                echo '<td>' . $position . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . ($selectedTable === 'klasyfikacja-ogolna' ? $row['score_ogolna'] : $row['score_extra']) . '</td>';
                echo '</tr>';

                $position++;
            }

            echo '</table>';
            ?>
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
        width: 100%;
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
        padding: 10px;
        border: none;
        outline: none;
        font-weight: 600;
        border-radius: 10px;
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
        border: 1px solid transparent;
        padding: 8px;
        text-align: center;
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

    .nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 15px;
    }

    .nav a {
        margin: 10px;
    }

    button {
        margin: 0 0 0 0 !important;
    }
</style>

</html>