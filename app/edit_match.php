<?php
$pageTitle = "Edytuj mecz";
include __DIR__ . '/global/section/header.php';
require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['match_id'])) {
        $matchId = $_GET['match_id'];

        // Zapytanie SQL do pobrania danych meczu
        $sqlGetMatch = "SELECT * FROM matches WHERE id = '$matchId'";
        $resultGetMatch = $conn->query($sqlGetMatch);

        if ($resultGetMatch && $resultGetMatch->num_rows > 0) {
            $matchData = $resultGetMatch->fetch_assoc();
?>

            <div class="body-container">
                <h2>Edytuj mecz</h2>
                <form method="POST" action="update_match.php">
                    <input type="hidden" name="match_id" value="<?php echo $matchData['id']; ?>">

                    <table class="edit-match-table">
                        <tr>
                            <td><label for="team1">Zespół (D):</label></td>
                            <td><input type="text" id="team1" name="team1" value="<?php echo $matchData['team1']; ?>" class="edit-input" required></td>
                        </tr>
                        <tr>
                            <td><label for="team2">Zespół (W):</label></td>
                            <td><input type="text" id="team2" name="team2" value="<?php echo $matchData['team2']; ?>" class="edit-input" required></td>
                        </tr>
                        <tr>
                            <td><label for="result1">Wynik (D):</label></td>
                            <td><input type="number" id="result1" name="result1" value="<?php echo $matchData['result1']; ?>" class="edit-input" max="10" min="0"></td>
                        </tr>
                        <tr>
                            <td><label for="result2">Wynik (W):</label></td>
                            <td><input type="number" id="result2" name="result2" value="<?php echo $matchData['result2']; ?>" class="edit-input" max="10" min="0"></td>
                        </tr>
                        <tr>
                            <td><label for="match_round">Runda:</label></td>
                            <td><input type="number" id="match_round" name="match_round" value="<?php echo $matchData['match_round']; ?>" class="edit-input" required></td>
                        </tr>
                        <tr>
                            <td><label for="match_date">Data:</label></td>
                            <td><input type="date" id="match_date" name="match_date" value="<?php echo $matchData['match_date']; ?>" class="edit-input" required></td>
                        </tr>
                        <tr>
                            <td><label for="is_jagiellonia">Jagiellonia:</label></td>
                            <td>
                                <select id="is_jagiellonia" name="is_jagiellonia" class="edit-input" required>
                                    <option value="1" <?php echo $matchData['is_jagiellonia'] ? 'selected' : ''; ?>>Tak</option>
                                    <option value="0" <?php echo !$matchData['is_jagiellonia'] ? 'selected' : ''; ?>>Nie</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="jagiellonia_player">Strzelec Jagiellonii:</label></td>
                            <td>
                                <select id="jagiellonia_player" name="jagiellonia_player">
                                    <option value="" <?php echo empty($matchData['jagiellonia_player_id']) ? 'selected' : ''; ?>>Brak</option>
                                    <?php
                                    // Pobierz listę zawodników Jagiellonii z bazy danych
                                    $sqlJagielloniaPlayers = "SELECT * FROM jagiellonia_players";
                                    $resultJagielloniaPlayers = $conn->query($sqlJagielloniaPlayers);

                                    // Wyświetl opcje wyboru
                                    while ($rowJagielloniaPlayer = $resultJagielloniaPlayers->fetch_assoc()) {
                                        $selected = ($rowJagielloniaPlayer['id'] == $matchData['jagiellonia_player_id']) ? 'selected' : '';
                                        echo "<option value='{$rowJagielloniaPlayer['id']}' $selected>{$rowJagielloniaPlayer['name']} {$rowJagielloniaPlayer['surname']}</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Zapisz zmiany" class="primary-button edit-save-changes">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

<?php
        } else {
            echo "Nie znaleziono meczu o ID $matchId.";
        }
    } else {
        echo "Nieprawidłowe żądanie.";
    }

    // Zamknięcie połączenia
    $conn->close();
} else {
    include __DIR__ . '/global/section/not-available.html';
}
include __DIR__ . '/global/section/footer.php';
?>
</body>

</html>