<?php
$pageTitle = "Typy Graczy";
include __DIR__ . '/global/section/header.php';
require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {

    $sqlUserPicks = "
    SELECT
        user_picks.id AS pick_id,
        users.username,
        matches.team1 AS team1,
        matches.team2 AS team2,
        matches.match_date,
        jagiellonia_players.surname AS jagiellonia_player_surname
    FROM user_picks
    JOIN users ON user_picks.user_id = users.id
    JOIN matches ON user_picks.match_id = matches.id
    LEFT JOIN jagiellonia_players ON user_picks.jagiellonia_player_pick_id = jagiellonia_players.id
";

    $resultUserPicks = $conn->query($sqlUserPicks);

?>

    <div class="body-container">
        <h2>Typy Graczy</h2>
        <table class="user-picks-table">
            <thead>
                <tr>
                    <th>ID Typu</th>
                    <th>Gracz</th>
                    <th>Drużyna (D)</th>
                    <th>Drużyna (W)</th>
                    <th>Data Meczu</th>
                    <th>Zawodnik Jagiellonii</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultUserPicks && $resultUserPicks->num_rows > 0) {
                    while ($row = $resultUserPicks->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['pick_id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['team1']}</td>
                            <td>{$row['team2']}</td>
                            <td>{$row['match_date']}</td>
                            <td>{$row['jagiellonia_player_surname']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Brak danych do wyświetlenia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php
} else {
    include __DIR__ . '/global/section/not-available.html';
}
include __DIR__ . '/global/section/footer.php';
$conn->close();
?>