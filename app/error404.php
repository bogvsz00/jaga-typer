<?php
$pageTitle = 'Strona główna';
$currentRound = '1';
include __DIR__ . '/global/section/header.php';
?>

<h1>Error 404!</h1>
<p id="not-found">Wskazana stronie nie istnieje!</p>
<style>
    h1 {
        text-align: center;
        margin-top: 50px;
    }

    #not-found {
        text-align: center;
        font-size: 1rem;
        color: var(--gray);
        margin-bottom: 50px;
    }
</style>
<link rel="stylesheet" href="style.css">
<?php
include __DIR__ . '/global/section/footer.php';
?>