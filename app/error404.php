<?php
$pageTitle = 'Wskazana strona nie istnieje!';
include __DIR__ . '/global/section/header.php';
?>

<body>
    <h1>Error 404!</h1>
    <p id="not-found">Wskazana stronie nie istnieje!</p>
    <a href="app\..\index.php">
        <button class="go-back-button">
            <i class="fas fa-sign-out-alt fa-xs"></i>&nbsp;&nbsp;Powrót na stronę główną
        </button>
    </a>
</body>
<style>
    @import "style/global-section.css";
    @import "style/themes.css";
    @import "style/style.css";

    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 40px;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    h1,
    #not-found,
    .go-back-button {
        margin: 0;
    }

    #not-found {
        font-size: 1rem;
        color: var(--gray);
        margin-bottom: 20px;
    }

    .go-back-button {
        margin-bottom: 60px;
    }
</style>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<?php
include __DIR__ . '/global/section/footer.php';
?>

</html>