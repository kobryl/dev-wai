<?php
require_once 'business.php';
require_once 'controller_utils.php';

function gallery(&$model) {
    $photosperpage = 3;
    $model['photos'] = [];
    $model['user'] = '';
    $dir = './images/thumbnails';
    $scanned_dir = array_diff(scandir($dir), array('..', '.'));
    foreach ($scanned_dir as $plik) {
        $model['photos'][] = '<a href="./images/watermark/' . $plik . '_watermark.png"><img src="' . $dir . '/' . $plik . '" alt="zdjęcie"></a>';
    }
    $model['totalpages'] = ceil(count($model['photos']) / $photosperpage);
    $model['photosperpage'] = $photosperpage;
    if (isset($_GET['page'])) {
        $model['page'] = $_GET['page'];
        $model['page'] = max($model['page'], 1);
        $model['page'] = min($model['page'], $model['totalpages']);
    } else $model['page'] = 1;
    return 'gallery_view';
}

function upload(&$model) {
    $model['result'] = '';
    $model['user'] = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES["file"])) {
            $file = $_FILES['file'];
            $watermark = $_POST['watermark'];
            $error_code = checkFileConds($file);
            if ($error_code == 0) {
                $upload_status = doUpload($file);
                if ($upload_status == 0) {
                    $model['result'] = "Plik " . $file['name'] . " został przesłany pomyślnie.";
                    createThumbnail($file, $_SERVER["DOCUMENT_ROOT"]);
                    createWatermark($file, $_SERVER["DOCUMENT_ROOT"], $watermark);
                    return 'upload_success';
                }
                else {
                    $model['result'] = 'upload_error';
                    return 'upload_view';
                }
            }
            else {
                $model['result'] = "<p style=\"color: red\">";
                switch ($error_code) {
                    case 1:
                        $model['result'] .= "Plik jest za duży. Maksymalny rozmiar przesyłanego pliku to 1 MB.";
                        break;
                    case 2:
                        $model['result'] .= "Niepoprawny format pliku.";
                        break;
                    case 3:
                        $model['result'] .= "Niepoprawny format pliku.<br>Plik jest za duży. Maksymalny rozmiar przesyłanego pliku to 1 MB.";
                        break;
                    case 4:
                        $model['result'] .= "Wystąpił błąd przy przesyłaniu pliku. Proszę spróbować później";
                        break;
                }
                $model['result'] .= "</p>";
                return 'upload_view';
            }
        }
        else {
            return 'redirect:upload';
        }
    }
    $model['user'] = "not implemented yet";
    return 'upload_view';
}

function login(&$model) {

}

function register(&$model) {

}