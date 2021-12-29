<html lang="pl">
    <head>
        <meta name="author" content="Konrad Bryłowski">
        <title>Kawoświat</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <header>
        <h1>Kawoświat</h1>
    </header>
    <main>
        <section id="gallery">
            <?php

            ?>
            <form name="upload" method="post" action="upload.php">
                <fieldset>
                    <label for="file">Prześlij zdjęcie:</label><br>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                    <input type="file" name="file" id="file" accept="image/png, image/jpeg" required><br>
                    <label for="watermark">Znak wodny:</label><br>
                    <input type="text" name="watermark" id="watermark" required>
                    <input type="submit" value="Prześlij"><br>
                </fieldset>
            </form>
        </section>
        <aside>
            <form name="login" method="post" action="login.php">
                <fieldset>
                    <label for="username">Nazwa użytkownika:</label><br>
                    <input type="text" id="username" name="username" required><br>
                    <label for="password">Hasło:</label><br>
                    <input type="password" id="password" name="password" required><br>
                    <input type="submit" value="Zaloguj"><br>
                </fieldset>
            </form>
            <form name="register" method="post" action="register.php">
                <fieldset>
                    <label for="new_user">Nazwa użytkownika:</label> <br>
                    <input type="text" name="username" id="new_user" required> <br>
                    <label for="new_password">Hasło:</label> <br>
                    <input type="password" id="new_password" name="password" required> <br>
                    <label for="new_rep_password">Powtórz hasło:</label> <br>
                    <input type="password" id="new_rep_password" name="rep_password" required> <br>
                    <input type="submit" value="Zarejestruj"> <br>

                </fieldset>
            </form>
        </aside>
    </main>
    <footer>
    <p>&copy; 2021 Konrad Bryłowski</p>
    </footer>
    </body>
</html>
