<?php
if (isset($_FILES['file'])) {
if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {

} else {
    echo "Wystąpił błąd w przesyłaniu pliku.<br><a href=\"index.php\">Wróć</a>";
    die();
}
} else {
    header("Location: index.php", 303);
    die();
}