<?php
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];

        if ($file["error"] == UPLOAD_ERR_OK) {
            $sizeFlag = 0;
            $typeFlag = 0;
            if ($file["size"] > 1048576) {
                $sizeFlag = 1;
            }
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($finfo, $file["tmp_name"]);
            if ($filetype != 'image/jpeg' && $filetype != 'image/png') {
                $typeFlag = 1;
            }
            if ($typeFlag == 1 && $sizeFlag == 1) {
                header("HTTP/1.1 415 Unsupported Media Type");
                echo ">Wróć</a>";
                die();
            }
            else {
                if ($typeFlag == 1) {
                    header("HTTP/1.1 415 Unsupported Media Type");
                    echo ">Wróć</a>";
                    die();
                }
                if ($sizeFlag == 1) {
                    header("HTTP/1.1 413 Payload Too Large");
                    echo ">Wróć</a>";
                    die();
                }
            }
            $uploaddir = $_SERVER["DOCUMENT_ROOT"] . '/images/';
            $uploadfile = $uploaddir . basename($file["name"]);
            if (move_uploaded_file($file["tmp_name"], $uploadfile)) {
                echo "Plik został przesłany pomyślnie.";
            }
            else {
                header("HTTP/1.1 500 Internal Server Error");
                echo ">Wróć</a>";
                die();
            }
        }
        else {
            header("HTTP/1.1 409 Conflict");
            echo ">Wróć</a>";
            die();
        }
    }
    else {
        header("Location: old_index.php", 302);
        die();
    }