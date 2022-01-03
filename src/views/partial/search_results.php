<?php for ($i = 0; $i < count($photos); $i++): ?>
<div class="galleryElement">
    <a href="<?= $addr['wm'][$i] ?>"><img src="<?= $addr['thumb'][$i] ?>" alt="zdjęcie"></a><br>
    <p>Tytuł: <?= $photos[$i]['title'] ?></p>
    <p>Autor: <?= $photos[$i]['author'] ?></p>
    <?php if (isset($photos[$i]['private']) and $photos[$i]['private'] == 'true'): ?>
    <p>Zdjęcie prywatne</p>
    <?php endif; ?>
</div>
<?php endfor; ?>