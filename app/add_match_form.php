<?php
session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {
?>

    <form method="POST" action="insert_match.php">
        <label for="team1">Zespół (D):</label>
        <input type="text" id="team1" name="team1" class="edit-input" required><br>

        <label for="team2">Zespół (W):</label>
        <input type="text" id="team2" name="team2" class="edit-input" required><br>

        <label for="result1">Wynik (D):</label>
        <input type="number" id="result1" name="result1" class="edit-input" max="10" min="0"><br>

        <label for="result2">Wynik (W):</label>
        <input type="number" id="result2" name="result2" class="edit-input" max="10" min="0"><br>

        <label for="match_round">Runda:</label>
        <input type="number" id="match_round" name="match_round" class="edit-input" required><br>

        <label for="match_date">Data:</label>
        <input type="date" id="match_date" name="match_date" class="edit-input" required><br>

        <label for="is_jagiellonia">Jagiellonia:</label>
        <select id="is_jagiellonia" name="is_jagiellonia" class="edit-input" required>
            <option value="1">Tak</option>
            <option value="0">Nie</option>
        </select><br>

        <input type="submit" value="Dodaj mecz" class="primary-button">
    </form>
<?php
} else {
    include __DIR__ . '/global/section/not-available.html';
}
?>