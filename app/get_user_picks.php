<?php
include __DIR__ . '/global/section/header.php';
require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {

    if (!isset($_GET['user_id'])) {
        die("Brak podanego ID użytkownika.");
    }

    if (!isset($_GET['round'])) {
        die("Brak podanej rundy.");
    }

    $userId = mysqli_real_escape_string($conn, $_GET['user_id']);
    $round = mysqli_real_escape_string($conn, $_GET['round']);

    // Pobranie wszystkich typów gracza dla danego użytkownika i rundy
    $query = "SELECT up.*, m.*, jp.surname AS jagiellonia_player_surname 
          FROM user_picks up
          JOIN matches m ON up.match_id = m.id
          JOIN jagiellonia_players jp ON up.jagiellonia_player_pick_id = jp.id
          WHERE up.user_id = $userId AND m.match_round = $round";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Błąd pobierania typów gracza: " . mysqli_error($conn));
    }

?>

    <!-- Wyświetlanie typów gracza -->
    <h2>Typy gracza</h2>
    <table border="1">
        <tr>
            <th>ID Meczu</th>
            <th>Drużyna 1</th>
            <th>Drużyna 2</th>
            <th>Wynik Drużyny 1</th>
            <th>Wynik Drużyny 2</th>
            <th>Typ drużyna 1</th>
            <th>Typ drużyna 2</th>
            <th>Strzelec Jagielloni</th>
        </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['match_id'] . "</td>";
        echo "<td>" . $row['team1'] . "</td>";
        echo "<td>" . $row['team2'] . "</td>";
        echo "<td>" . $row['result1'] . "</td>";
        echo "<td>" . $row['result2'] . "</td>";
        echo "<td>" . $row['pick_result1'] . "</td>";
        echo "<td>" . $row['pick_result2'] . "</td>";
        echo "<td>" . $row['jagiellonia_player_surname'] . "</td>";
        echo "</tr>";
    }
} else {
    include __DIR__ . '/global/section/not-available.html';
}
    ?>
    </table>