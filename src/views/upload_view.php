<!DOCTYPE html>
<html lang="pl">
    <?php
        include 'head.php';
    ?>
        <form name="upload" method="post" action="/upload" enctype="multipart/form-data">
            <fieldset>
                <legend>Przesyłanie zdjęcia</legend>
                <label for="title">Tytuł:</label><br>
                <input type="text" name="title" id="title"><br>
                <label for="author">Autor:</label><br>
                <input type="text" name="author" id="author" value="<?=$user?>"><br>
                <label for="file">Wybierz plik (JPEG/PNG):</label><br>
                <input type="file" name="file" id="file" accept="image/png, image/jpeg" required><br>
                <label for="watermark">Znak wodny:</label><br>
                <input type="text" name="watermark" id="watermark" required><br>
                <input type="submit" value="Prześlij"><br>
            </fieldset>
            <p style="color: red;">
                <?= $result ?>
            </p>
        </form>
    <?php
        include 'foot.php';
    ?>
</html>