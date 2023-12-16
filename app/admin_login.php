<?php
$pageTitle = "Logowanie administratora";
include __DIR__ . '/global/section/header.php';
?>

<body>
    <h2>Zaloguj się do panelu</h2>
    <form action="process_login.php" method="post">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Zaloguj się" class="primary-button login-button">
    </form>
</body>
<style>
    @import "style/global-section.css";
    @import "style/themes.css";
    @import "style/style.css";

    body {
        margin: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    form {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        margin-bottom: 16px;
    }

    h2 {
        margin-bottom: 20px;
    }

    label {
        color: var(--gray);
        font-size: 12px;
    }
</style>
<link rel="stylesheet" href="style.css">
<?php
include __DIR__ . '/global/section/footer.php';
?>
</body>

</html>