<?php
$pageTitle = "Panel administratora";
include __DIR__ . '/global/section/header.php';

require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {
    echo "<h2>Panel administratora</h2>";
    function displayMatchesForRound($round, $conn)
    {
        $sql = "SELECT * FROM matches";
        if ($round != 'all') {
            $sql .= " WHERE match_round = '$round'";
        }
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>ID</th>
                            <th>Zespół (D)</th>
                            <th>Zespół (W)</th>
                            <th>Wynik (D)</th>
                            <th>Wynik (W)</th>
                            <th>Runda</th>
                            <th>Data</th>
                            <th><img src='src/image/Herb_Jagielloni.png' width='20px'/></th>
                            <th>Usuń mecz</th>
                        </tr>";

                // Wyświetlanie wyników
                while ($row = $result->fetch_assoc()) {
                    $result1 = ($row["result1"] !== null) ? $row["result1"] : "❓";
                    $result2 = ($row["result2"] !== null) ? $row["result2"] : "❓";

                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["team1"] . "</td>
                            <td>" . $row["team2"] . "</td>
                            <td>" . $result1 . "</td>
                            <td>" . $result2 . "</td>
                            <td>" . $row["match_round"] . "</td>
                            <td>" . $row["match_date"] . "</td>
                            <td>" . ($row["is_jagiellonia"] ? '✔️' : '❌') . "</td>
                            <td><form method='POST' action='remove_match.php'>
                                <input type='hidden' name='match_id' value='" . $row["id"] . "'>
                                <button type='submit' class='reset-button'>Usuń</button>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "Brak wyników dla kolejki $round";
            }
        } else {
            echo "Błąd w zapytaniu SQL: " . $conn->error;
        }
    }


    $sqlAllRounds = "SELECT DISTINCT match_round FROM matches";
    $resultAllRounds = $conn->query($sqlAllRounds);

    // Sprawdzenie czy są wyniki
    if ($resultAllRounds) {
        if ($resultAllRounds->num_rows > 0) {
            echo "<div>";
            echo "<form method='GET'>";
            echo "<button class='primary-button' name='round' value='all'>Wszystkie mecze</button>";

            // Wyświetlanie przycisków dla poszczególnych kolejek
            while ($row = $resultAllRounds->fetch_assoc()) {
                echo "<button class='primary-button' name='round' value='" . $row["match_round"] . "'>Kolejka " . $row["match_round"] . "</button>";
            }
            echo "</form>";
            echo "</div>";

            // Sprawdzenie czy przesłano formularz
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['round'])) {
                $selectedRound = $_GET['round'];
                displayMatchesForRound($selectedRound, $conn);
            } else {
                displayMatchesForRound('all', $conn); // Wyświetlanie wszystkich meczów domyślnie
            }
        } else {
            echo "Brak danych o kolejkach";
        }
    } else {
        echo "Błąd w zapytaniu SQL: " . $conn->error;
    }

    // Zamknięcie połączenia
    $conn->close();
} else {
    include __DIR__ . '/global/section/not-available.html';
}
?>
</div>
</body>
<style>
    .reset-button {
        width: 50px;
    }

    .primary-button {
        width: 150px;
    }
</style>
<?php
include __DIR__ . '/global/section/footer.php';
?>

</html>
