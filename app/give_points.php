<?php
include __DIR__ . '/global/section/header.php';
require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
        $matchId = isset($_POST['match_id']) ? $_POST['match_id'] : null;
        $ogolnaPoints = isset($_POST['ogolna_points']) ? $_POST['ogolna_points'] : null;
        $extraPoints = isset($_POST['extra_points']) ? $_POST['extra_points'] : null;

        if ($userId !== null && $matchId !== null && $ogolnaPoints !== null && $extraPoints !== null) {
            $checkUserQuery = "SELECT * FROM user_scores WHERE user_id = $userId";
            $checkUserResult = mysqli_query($conn, $checkUserQuery);

            if (mysqli_num_rows($checkUserResult) > 0) {

                $updatePointsQuery = "UPDATE user_scores SET
                                score_ogolna = score_ogolna + $ogolnaPoints,
                                score_extra = score_extra + $extraPoints
                                WHERE user_id = $userId";

                $updatePointsResult = mysqli_query($conn, $updatePointsQuery);

                if ($updatePointsResult) {
                    echo 'Punkty zostały zaktualizowane.';
                } else {
                    echo 'Błąd podczas aktualizacji punktów: ' . mysqli_error($conn);
                }
            } else {
                $insertPointsQuery = "INSERT INTO user_scores (user_id, score_ogolna, score_extra)
                                VALUES ($userId, $ogolnaPoints, $extraPoints)";

                $insertPointsResult = mysqli_query($conn, $insertPointsQuery);

                if ($insertPointsResult) {
                    echo 'Dodano nowego użytkownika do tabeli punktów.';
                } else {
                    echo 'Błąd podczas dodawania nowego użytkownika: ' . mysqli_error($conn);
                }
            }
        } else {
            echo 'Nieprawidłowe dane przesłane przez formularz.';
        }
    }

    $sql = "SELECT up.id AS type_id, up.user_id, up.match_id, u.username, m.team1, m.team2, up.pick_result1 AS type_team1, up.pick_result2 AS type_team2, jp.name AS jagiellonia_player
        FROM user_picks up
        INNER JOIN users u ON up.user_id = u.id
        INNER JOIN matches m ON up.match_id = m.id
        LEFT JOIN jagiellonia_players jp ON m.jagiellonia_player_id = jp.id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<table border="1">
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>D1</th>
                <th>D2</th>
                <th>T1</th>
                <th>T2</th>
                <th>S. J.</th>
                <th>Akcje</th>
            </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['type_id'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['team1'] . '</td>';
            echo '<td>' . $row['team2'] . '</td>';
            echo '<td>' . $row['type_team1'] . '</td>';
            echo '<td>' . $row['type_team2'] . '</td>';
            echo '<td>' . ($row['jagiellonia_player'] ? $row['jagiellonia_player'] : '-') . '</td>';
            echo '<td>
                <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
                    <input type="hidden" name="user_id" value="' . $row['user_id'] . '">
                    <input type="hidden" name="match_id" value="' . $row['match_id'] . '"><br>
                    <label for="ogolna_points">Ogólne:</label>
                    <input type="text" name="ogolna_points" style="width: 25px; height: 18px;" required><br>
                    <label for="extra_points">Extra:</label>
                    <input type="text" name="extra_points" required style="width: 25px; height: 18px;"><br>
                    <button class="primary-button "type="submit">Dodaj punkty</button>
                </form>
            </td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'Błąd zapytania SQL: ' . mysqli_error($conn);
    }

?>

<?php
} else {
    include __DIR__ . '/global/section/not-available.html';
}
include __DIR__ . '/global/section/footer.php';
$conn->close();
?>
