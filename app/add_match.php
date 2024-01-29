<?php
$pageTitle = "Dodaj nowy mecz";
include __DIR__ . '/global/section/header.php';
require __DIR__ . '/global/global-db/db_config.php';

session_start();
$isLogged = $_SESSION['isLogged'];

if ($isLogged == true) {
?>
    <div class="body-container">
        <h2>Dodaj nowy mecz</h2>
        <?php include 'add_match_form.php'; ?>
    </div>
<?php
} else {
    include __DIR__ . '/global/section/not-available.html';
}
include __DIR__ . '/global/section/footer.php';
?>
</body>
<style>
    .body-container {
        padding: 10px;
    }
</style>

</html>