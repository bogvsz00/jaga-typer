<?php
$pageTitle = "Panel administratora";
include __DIR__ . '/global/section/header.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {
?>

    <body>
        <div class="body-container">
            <h1>Panel administratora</h1>
            <h2 class="brand-gray">JagaTyper 2024/2025</h2>
            <div class="nav" style='margin-left: -10px'>
                <a href="matches_list.php">
                    <button class="primary-button a-panel-button"><i class="fas fa-futbol"></i>&nbsp;&nbsp;Edytuj lub usuń mecz</button>
                </a>
                <a href="add_match.php">
                    <button class="primary-button a-panel-button"><i class="fas fa-trophy"></i>&nbsp;&nbsp;Dodaj nowy mecz</button>
                </a>
                <a href="display_users_picks.php">
                    <button class="primary-button a-panel-button"><i class="fas fa-file-invoice"></i>&nbsp;&nbsp;Pokaż typy</button>
                </a>
                <a href="change_round.php">
                    <button class="primary-button a-panel-button"><i class="fas fa-sync"></i>&nbsp;&nbsp;Zmień rundę</button>
                </a>
                <a href="give_points.php">
                    <button class="primary-button a-panel-button"><i class="fas fa-user"></i>&nbsp;&nbsp;Punktacja</button>
                </a>
            </div>
        </div>
    <?php
} else {
    include __DIR__ . '/global/section/not-available.html';
}
include __DIR__ . '/global/section/footer.php';
    ?>
    </body>

    </html>