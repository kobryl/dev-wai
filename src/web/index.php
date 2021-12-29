<html lang="pl">
    <head>
        <meta name="author" content="Konrad Bryłowski">
        <title>Kawoświat</title>
    </head>
    <body>
    <header>
        <h1>Kawoświat</h1>
    </header>
    <main>

        <aside>
            <form name="login" method="post" action="login.php">
                <fieldset>
                    <label for="username">Nazwa użytkownika</label>
                    <input type="text" id="username" name="username">
                    <label for="password">Hasło</label>
                    <input type="password" id="password" name="password">
                    <input type="submit" value="Zaloguj">
                </fieldset>
            </form>
            <form name="register" method="post" action="register.php">
                <fieldset>
                    <label for="new_user">Nazwa użytkownika</label>
                    <input type="text" name="username" id="new_user">
                    <label for="new_password">Hasło</label>
                    <input type="password" id="new_password" name="password">
                    <label for="new_rep_password">Hasło</label>
                    <input type="password" id="new_rep_password" name="rep_password">
                    <input type="submit" value="Zarejestruj">
                </fieldset>
            </form>
        </aside>
    </main>
    <footer>

    </footer>
    </body>
</html>
