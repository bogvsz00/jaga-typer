<?php
$pageTitle = 'Strona główna';
include __DIR__ . '/global/section/header.php';
// require_once('global/global-db/db-config.php')
?>


<?php 
 $currentRound = '1';
?>

<body>
    <div class="container">
        <h1>Jaga Typer</h1>
        <h2 class="season-header">Sezon 24/25</h2>
        <br>
        <h3 class="round-header"><span class="brand-warning"><?php echo $currentRound ?></span>. kolejka Ekstraklasy
        <hr>
        
        <div class="bet-panel">
            <?php
            require_once('global/global-db/db_config.php');
            // ! TODO
            $sql = "SELECT * FROM matches WHERE match_date > NOW()";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<form method='post' action='submit_picks.php'>";
                echo "<label>Nick użytkownika: <input type='text' name='username' required></label><br>";
                echo "<table>";
                echo "<tr><th>Mecz</th><th>Wynik (D)</th><th>Wynik (W)</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['team1']} - {$row['team2']}</td>";
                    echo "<td><input type='number' class='score-input' name='result1[]' required></td>";
                    echo "<td><input type='number' clas='score-input' name='result2[]' required></td>";
                    echo "<input type='hidden' name='match_id[]' value='{$row['id']}'>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "<input class='submit-button' type='submit' value='Zatwierdź obstawienia'>";
                echo "</form>";
            } else {
                echo "Brak dostępnych meczy.";
            }

            $conn->close();
            ?>
        </div>
        <div class="leaderboard-panel">

        </div>
</body>

</html>
</div>
</div>
</body>

<link rel="stylesheet" href="style.css">
<?php
include __DIR__ . '/global/section/footer.php';
?>