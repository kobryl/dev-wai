<?php
    if (isset($_FILES["file"])) {
        if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
            if ($_FILES["file"]["size"] > 1048576) {
                header("HTTP/1.1 413 Payload Too Large");
                echo "Plik jest za duży. Maksymalny rozmiar przesyłanego pliku to 1 MB.<br><a href=\"index.php\">Wróć</a>";
                die();
            }
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
            if ($filetype != 'image/jpeg' && $filetype != 'image/png') {
                header("HTTP/1.1 415 Unsupported Media Type");
                echo "Niepoprawny format pliku.<br><a href=\"index.php\">Wróć</a>";
                die();
            }
            $uploaddir = $_SERVER["DOCUMENT_ROOT"] . '/images/';
            $uploadfile = $uploaddir . basename($_FILES["file"]["name"]);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile)) {
                header("HTTP/1.1 200 OK");
            }
            else {
                header("HTTP/1.1 500 Internal Server Error");
            }
        }
        else {
            header("HTTP/1.1 409 Conflict");
            echo "Wystąpił błąd w przesyłaniu pliku.<br><a href=\"index.php\">Wróć</a>";
            die();
        }
    }
    else {
        header("Location: index.php", 303);
        die();
    }