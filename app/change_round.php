<?php
$pageTitle = "Zmień rundę";
include __DIR__ . '/global/section/header.php';
require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {

    $sql = "SELECT current_round FROM admin_settings";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentRound = $row['current_round'];
    } else {
        $currentRound = 'Brak danych';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["newRound"])) {
            $newRound = $_POST["newRound"];

            $updateSql = "UPDATE admin_settings SET current_round = '$newRound'";
            if ($conn->query($updateSql) === TRUE) {
                $currentRound = $newRound;
            } else {
                echo "Błąd podczas aktualizacji rundy: " . $conn->error;
            }
        }
    }
?>

    <body>
        <div class="body-container">
            <h1>Zmień rundę</h1>
            <h2 class="brand-gray">Obecna runda: <?php echo $currentRound; ?></h2>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="newRound">Nowa runda:</label>
                <input type="number" name="newRound" required>
                <input type="submit" value="Zmień rundę">
            </form>
        </div>
    <?php
} else {
    include __DIR__ . '/global/section/not-available.html';
}
include __DIR__ . '/global/section/footer.php';
$conn->close();
    ?>
    </body>

    </html>