<!DOCTYPE html>
<html lang="pl">
    <?php
        include 'head.php';
    ?>
        <main>
            <section id="gallery">
                <div id="page_info">
                    <?php
                    include 'page_info.php';
                    ?>
                </div>
                <form method="post" action="/bookmarked?page=<?= $page ?>">
                    <div class="galleryContainer">
                        <?php
                            $mode = 'bookmarked';
                            include 'gallery.php';
                        ?>
                    </div>
                    <input type="submit" value="Usuń zaznaczone z zapamiętanych">
                </form>
            </section>
        </main>
    <?php
        include 'foot.php';
    ?>
</html>