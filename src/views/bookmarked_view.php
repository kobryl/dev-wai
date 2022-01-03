<!DOCTYPE html>
<html lang="pl">
    <?php
        include 'includes/head.php';
    ?>
        <main>
            <section id="gallery">
                <div id="page_info">
                    <?php
                    include 'partial/page_info.php';
                    ?>
                </div>
                <form method="post" action="/bookmarked?page=<?= $page ?>">
                    <div class="galleryContainer">
                        <?php
                            $mode = 'bookmarked';
                            include 'partial/gallery.php';
                        ?>
                    </div>
                    <input type="submit" value="Usuń zaznaczone z zapamiętanych">
                </form>
            </section>
        </main>
    <?php
        include 'includes/foot.php';
    ?>
</html>