<?php

require 'vendor/autoload.php';
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
    $img = getSrcImg($file, $dir);
    $destImgPath = $dir . '/images/watermark/' . $file['name'] . '_watermark.png';

    list($width, $height) = getimagesize($dir . '/images/' . $file['name']);
    $font = realpath('.') . '/static/fonts/arial.ttf';
    $size = $width*4/100;

    $bbox = imagettfbbox($size, 0, $font, 'ky');
    $x = 8; $y = 8 - $bbox[5];

    $black = imagecolorallocatealpha($img, 0, 0, 0, 100);
    $white = imagecolorallocatealpha($img, 255, 255, 255, 85);
    imagettftext($img, $size, 0, $x + 1, $y + 1, $black, $font, $watermark);
    imagettftext($img, $size, 0, $x + 0, $y + 1, $black, $font, $watermark);
    imagettftext($img, $size, 0, $x + 0, $y + 0, $white, $font, $watermark);

    imagepng($img, $destImgPath);
    imagedestroy($img);
}

function saveImgInfo($name, $author, $title) {
    $db = get_db();
    $photo = [
        'name' => $name,
        'author' => $author,
        'title' => $title
    ];
    $db->photos->insertOne($photo);
}

function getPhoto($name) {
    try {
        $db = get_db();
        $photo = $db->photos->findOne([
            'name' => $name
        ]);
        return $photo;
    } catch (Exception $e) {
        var_dump($e);
        return ['', '', ''];
    }
}

function getImgAuthor($name) {
    $photo = getPhoto($name);
    return $photo['author'];
}

function getImgTitle($name) {
    $photo = getPhoto($name);
    return $photo['title'];
}

function readUser($username, $password) {
    try {
        $db = get_db();
        $user = $db->users->findOne(['username' => $username]);
        if ($user !== null && password_verify($password, $user['password'])) {
            session_regenerate_id();
            $_SESSION['user_id'] = $user['_id'];
            return true;
        } else return false;
    } catch (Exception $e) {
        return $e;
    }
}

function getUserById($id) {
    try {
        $db = get_db();
        $user = $db->users->findOne(['_id' => $id]);
        if ($user !== null)
            return $user['username'];
        else return '';
    } catch (Exception $e) {
        return $e;
    }
}

function isUsernameFree($username) {
    try {
        $db = get_db();
        $user = $db->users->findOne(['username' => $username]);
        if ($user === null) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return $e;
    }
}

function addUser($email, $username, $password) {
    try {
        $db = get_db();
        $user = $db->users->insertOne([
            'email' => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        return 0;
    } catch (Exception $e) {
        return $e;
    }
}

function &getPhotos() {
    $photos = [];
    try {
        $db = get_db();
        $photos = $db->photos->find();
        return $photos;
    } catch (Exception $e) {
        return $photos;
    }
}

function getAddr($dir, $file) {
    return $dir . '/' . $file;
}

function getArr($mongo) {
    $arr = [];
    foreach ($mongo as $key => $value) {
        $arr[$key] = $value;
    }
    return $arr;
}
