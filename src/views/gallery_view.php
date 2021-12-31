<!DOCTYPE html>
<html lang="pl">
    <?php
        include 'head.php';
    ?>
        <main>
            <section id="gallery">
                <?php
                    $prevLink = '<button type="button" '. ($page == 1 ? 'disabled>' : '>') . '<a href=?page=' . $page - 1 . '>&larr;</a></button>';
                    $nextLink = '<button type="button" '. ($page == $totalpages ? 'disabled>' : '>') . '<a href=?page=' . $page + 1 . '>&rarr;</a></button>';
                    $firstLink = '<button type="button" '. ($page == 1 ? 'disabled>' : '>') . '<a href=?page=' . 1 . '>&llarr;</a></button>';
                    $lastLink = '<button type="button" '. ($page == $totalpages ? 'disabled>' : '>') . '<a href=?page=' . $totalpages . '>&rrarr;</a></button>';
                ?>
                <div id="page_info">
                    <p>Strona <?=$page?> z <?=$totalpages?></p>
                    <p class="nav_btns"><?=$firstLink . ' ' . $prevLink . ' ' . $nextLink . ' ' . $lastLink?></p>
                </div>
                <?php
                    for ($i = ($page - 1) * $photosperpage; $i < min($page * $photosperpage, count($photos)); $i++)
                        echo $photos[$i];
                ?>
            </section>
            <aside>
                <a href="/login">Zaloguj</a>
                <!--
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
                -->
            </aside>
        </main>
    <?php
        include 'foot.php';
    ?>
</html>