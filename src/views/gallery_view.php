<!DOCTYPE html>
<html lang="pl">
    <?php
        include 'head.php';
    ?>
        <main>
            <section id="gallery">
                <div id="page_info">
                    <p>Strona <?=$page?> z <?=$totalpages?></p>
                    <p class="nav_btns">
                        <a href="?page=1" onclick="return <?= $page > 1?>;"><button type="button" <?=$page == 1 ? 'disabled' : ''?>>&llarr;</button></a>
                        <a href="?page=<?= $page - 1 ?>" onclick="return <?= $page > 1?>;"><button type="button" <?=$page == 1 ? 'disabled' : ''?>>&larr;</button></a>
                        <a href="?page=<?= $page + 1 ?>" onclick="return <?= $page < $totalpages?>;"><button type="button" <?=$page == $totalpages ? 'disabled' : ''?>>&rarr;</button></a>
                        <a href="?page=<?= $totalpages ?>" onclick="return <?= $page < $totalpages?>;"><button type="button" <?=$page == $totalpages ? 'disabled' : ''?>>&rrarr;</button></a>
                    </p>
                </div>
                <form method="post" action="/gallery?page=<?= $page ?>">
                    <div class="galleryContainer">
                        <?php
                            for ($i = ($page - 1) * $photosperpage; $i < min($page * $photosperpage, count($photos)); $i++) {
                                echo '<div class="galleryElement">';
                                echo '<a href="' . $addr['wm'][$i] . '"><img src="' . $addr['thumb'][$i] . '" alt="zdjęcie"></a>';
                                echo '<br><p>Tytuł: '. $photos[$i]['title'] . '</p>';
                                echo '<p>Autor: ' . $photos[$i]['author'] . '</p>';
                                echo '<input type="checkbox" name="remember[]" id="remember_' . $i . '" value="' . $photos[$i]["_id"] . '" ' . (in_array($photos[$i]['_id'], $_SESSION['remembered']) ? 'checked disabled' : ' ') . '><label for="remember_' . $i .'">zapamiętaj</label>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                    <input type="submit" value="Zapamiętaj wybrane">
                </form>
            </section>
        </main>
    <?php
        include 'foot.php';
    ?>
</html>