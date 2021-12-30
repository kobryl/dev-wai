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

function getFileType($file) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    return finfo_file($finfo, $file["tmp_name"]);
}

function checkFileConds($file) {
    if ($file["error"] == UPLOAD_ERR_OK) {
        $sizeFlag = 0;
        $typeFlag = 0;
        if ($file["size"] > 1048576) {
            $sizeFlag = 1;
        }
        $filetype = getFileType($file);
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

function getSrcImg($file, $dir) {
    $name = $file['name'];
    $path = $dir . '/images/' . $name;
    $type = mime_content_type($path);
    $thumbPath = $dir . '/images/thumbnails/' . $name;
    switch($type) {
        case "image/jpeg":
            $create_command = 'imagecreatefromjpeg';
            break;
        default:
            $create_command = 'imagecreatefrompng';
    }
    return $create_command($path);
}

function createThumbnail($file, $dir) {
    $thumbH = 125;
    $thumbW = 200;
    $srcImg = getSrcImg($file, $dir);
    $srcW = imagesx($srcImg);
    $srcH = imagesy($srcImg);
    $destImg = imagecreatetruecolor($thumbW, $thumbH);
    $destImgPath = $dir . '/images/thumbnails/' . $file['name'];
    imagecopyresampled($destImg, $srcImg, 0, 0, 0, 0, $thumbW, $thumbH, $srcW, $srcH);
    imagejpeg($destImg, $destImgPath);
    imagedestroy($srcImg);
    imagedestroy($destImg);
}

function createWatermark($file, $dir, $watermark) {
    $srcImg = getSrcImg($file, $dir);
    $srcW = imagesx($srcImg);
    $srcH = imagesy($srcImg);
    $destImg = imagecreatetruecolor($srcW, $srcH);
    $destImgPath = $dir . '/images/watermark/' . $file['name'];
    imagecopy($destImg, $srcImg, 0, 0, 0, 0, $srcW, $srcH);
    $margRight = 10;
    $margBottom = 10;
    imagestring($destImg, 1, 10, 10, $watermark, imagecolorallocatealpha($destImg, 124, 124, 124, 85));
    imagejpeg($destImg, $destImgPath);
    imagedestroy($srcImg);
    imagedestroy($destImg);
}
