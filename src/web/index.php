<?php

?>
<html lang="pl">
    <head>
        <meta name="author" content="Konrad Bryłowski">
        <title>Kawoświat</title>
        <link rel="stylesheet" type="text/css" href="static/css/style.css">
    </head>
    <body>
    <header>
        <h1>tytuł</h1>
    </header>
    <main>
        <section id="gallery">
            <h6>Galeria</h6>
            <form action="418.php">
                <input type="submit" value="Zaparz kawę">
            </form>
            <form name="upload" method="post" action="upload.php" enctype="multipart/form-data">
                <fieldset>
                    <legend>Przesyłanie zdjęcia</legend>
                    <label for="title">Tytuł:</label><br>
                    <input type="text" name="title" id="title"><br>
                    <label for="author">Autor:</label><br>
                    <input type="text" name="author" id="author" value="<?php

                    ?>"><br>
                    <label for="file">Wybierz plik (JPEG/PNG):</label><br>
                    <input type="file" name="file" id="file" accept="image/png, image/jpeg" required><br>
                    <label for="watermark">Znak wodny:</label><br>
                    <input type="text" name="watermark" id="watermark" required><br>
                    <input type="submit" value="Prześlij"><br>
                </fieldset>
            </form>
        </section>
        <aside>
            <form name="login" method="post" action="login.php">
                <fieldset>
                    <legend>Logowanie</legend>
                    <label for="username">Nazwa użytkownika:</label><br>
                    <input type="text" id="username" name="username" required><br>
                    <label for="password">Hasło:</label><br>
                    <input type="password" id="password" name="password" required><br>
                    <input type="submit" value="Zaloguj"><br>
                </fieldset>
            </form>
            <form name="register" method="post" action="register.php">
                <fieldset>
                    <legend>Rejestracja</legend>
                    <label for="email_addr">Adres email:</label><br>
                    <input type="email" name="email_addr" id="email_addr">
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
