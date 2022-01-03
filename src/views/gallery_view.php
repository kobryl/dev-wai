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
                <form method="post" action="/gallery?page=<?= $page ?>">
                    <div class="galleryContainer">
                        <?php
                            $mode = 'gallery';
                            include 'partial/gallery.php';
                        ?>
                    </div>
                    <input type="submit" value="Zapamiętaj wybrane">
                </form>
            </section>
        </main>
    <?php
        include 'includes/foot.php';
    ?>
</html>