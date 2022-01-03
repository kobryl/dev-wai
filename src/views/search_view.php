<!DOCTYPE html>
<html lang="pl">
    <?php
        include 'includes/head.php';
    ?>
        <main>
            <section id="search">
                <label for="search_input">Wpisz wyszukiwany tytuł:</label><br>
                <input type="text" name="search" id="search_input" onkeyup="search(this)">
            </section>
            <section id="gallery">
                <div id="galleryContainer">
                    <p>Brak zdjęć do wyświetlenia</p>
                </div>
            </section>
        </main>
        <script>
            function search(param) {
                if (param.value.length === 0) {
                    document.getElementById("galleryContainer").innerHTML = "<p>Brak zdjęć do wyświetlenia</p>";
                } else {
                    const ajax = new XMLHttpRequest();
                    ajax.onload = function () {
                        document.getElementById("galleryContainer").innerHTML = this.responseText;
                    }
                    ajax.open("POST", "/search");
                    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    ajax.send(("search=" + param.value));
                }
            }
        </script>
    <?php
        include 'includes/foot.php';
    ?>
</html>
