<?php if ($totalpages > 0): ?>
    <p>Strona <?=$page?> z <?=$totalpages?></p>
    <p class="nav_btns">
        <a href="?page=1" onclick="return <?= $page > 1?>;"><button type="button" <?=$page == 1 ? 'disabled' : ''?>>&llarr;</button></a>
        <a href="?page=<?= $page - 1 ?>" onclick="return <?= $page > 1?>;"><button type="button" <?=$page == 1 ? 'disabled' : ''?>>&larr;</button></a>
        <a href="?page=<?= $page + 1 ?>" onclick="return <?= $page < $totalpages?>;"><button type="button" <?=$page == $totalpages ? 'disabled' : ''?>>&rarr;</button></a>
        <a href="?page=<?= $totalpages ?>" onclick="return <?= $page < $totalpages?>;"><button type="button" <?=$page == $totalpages ? 'disabled' : ''?>>&rrarr;</button></a>
    </p>
<?php else: ?>
    <p>Brak zdjęć do wyświetlenia</p>
<?php endif; ?>
