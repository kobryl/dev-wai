<?php
for ($i = ($page - 1) * $photosperpage; $i < min($page * $photosperpage, count($photos)); $i++) {
    echo '<div class="galleryElement">';
    echo '<a href="' . $addr['wm'][$i] . '"><img src="' . $addr['thumb'][$i] . '" alt="zdjęcie"></a>';
    echo '<br><p>Tytuł: '. $photos[$i]['title'] . '</p>';
    echo '<p>Autor: ' . $photos[$i]['author'] . '</p>';
    if (isset($photos[$i]['private']) and $photos[$i]['private'] == 'true') {
        echo '<p>Zdjęcie prywatne</p>';
    }
    echo '<input type="checkbox" name="remember[]" id="remember_' . $i . '" value="' . $photos[$i]["_id"] . '" ' . ($mode == 'gallery' ? (in_array($photos[$i]['_id'], $_SESSION['remembered']) ? 'checked disabled' : ' ') : ' ') . '><label for="remember_' . $i .'">' . ($mode == 'gallery' ? 'zapamiętaj' : 'zapomnij') . '</label>';
    echo '</div>';
}
