<?php

use MongoDB\BSON\ObjectId;

function get_db() {
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b'
        ]);

    $db = $mongo->wai;

    return $db;
}

function checkFileConds($file) {
    if ($file["error"] == UPLOAD_ERR_OK) {
        $sizeFlag = 0;
        $typeFlag = 0;
        if ($file["size"] > 1048576) {
            $sizeFlag = 1;
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $filetype = finfo_file($finfo, $file["tmp_name"]);
        if ($filetype != 'image/jpeg' && $filetype != 'image/png') {
            $typeFlag = 2;
        }
        return $typeFlag + $sizeFlag;
    }
    return 4;
}

function doUpload($file) {
    $uploaddir = $_SERVER["DOCUMENT_ROOT"] . '/images/';
    $uploadfile = $uploaddir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $uploadfile)) {
        return 0;
    }
    else {
        return 1;
    }
}
