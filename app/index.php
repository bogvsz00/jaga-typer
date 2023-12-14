    <?php
    $pageTitle = 'Strona główna';
    $currentRound = '1';
    include __DIR__ . '/global/section/header.php';
    ?>

    <body>
        <div class="container">
            <h1>Jaga Typer</h1>
            <h2 class="season-header brand-gray">Sezon 24/25</h2>
            <div class="nav" style="margin-top:20px;">
                <a href="/">
                    <button class="pick-round-button"><i class="fas fa-futbol"></i>&nbsp;&nbsp;Nachodząca kolejka</button>
                </a>
                <a href="/">
                    <button class="leaderboard-button"><i class="fas fa-trophy"></i>&nbsp;&nbsp;Tabela wyników</button>
                </a>
            </div>
            <br>
            <h3 class="round-header">
                <span class="brand-primary"><?php echo $currentRound ?></span>. kolejka Ekstraklasy
                <hr>

                <div class="bet-panel">
                    <?php
                    require __DIR__ . '/global/global-db/db_config.php';

                    $sql = "SELECT * FROM matches WHERE match_date > NOW()";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<form method='post' action='submit_picks.php'>";
                        echo "<input type='hidden' name='selected_round' value='$currentRound'>";
                        echo "<div class='adnt-container'>";
                        echo "<i class='far fa-question-circle fa-xs adnotation-icon'></i>";
                        echo "<span class='adnt-brand-text'>Wprowadź tutaj nazwę, która ma za każdym razem wyświetlać się w tabeli wyników</span>";
                        echo "</div>";
                        echo "<label class='user-label'><i class='fas fa-user fa-xs' style='margin-right: 7px;'></i>&nbsp;Nazwa gracza: <input type='text' name='username' required></label><br>";
                        echo "<table>";
                        echo "<tr><th>Mecz</th><th>Wynik (D)</th><th>Wynik (W)</th><th>Zawodnik Jagiellonii</th></tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['team1']} - {$row['team2']}</td>";
                            echo "<td><input type='number' class='score-input' name='result1[]' max='10' min='0' required></td>";
                            echo "<td><input type='number' class='score-input' name='result2[]' max='10' min='0' required></td>";

                            if (strpos($row['team1'], 'Jagiellonia') !== false || strpos($row['team2'], 'Jagiellonia') !== false) {
                                echo "<td><select name='jagiellonia_players[]' required>";

                                $playersSql = "SELECT id, name, surname FROM jagiellonia_players";
                                $playersResult = $conn->query($playersSql);
                                while ($playerRow = $playersResult->fetch_assoc()) {
                                    echo "<option value='{$playerRow['id']}'><img src='app/src/image/favicon/favicon.ico'/>{$playerRow['name']} {$playerRow['surname']}</option>";
                                }
                                echo "</select></td>";
                            } else {
                                echo "<td></td>";
                            }

                            echo "<input type='hidden' name='match_id[]' value='{$row['id']}'>";
                            echo "</tr>";
                        }

                        echo "</table>";
                        echo "<input class='submit-button' type='submit' value='Zatwierdź obstawienia'>";
                        echo "<input class='reset-button' type='reset' value='Zresetuj'>";
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

    </html>