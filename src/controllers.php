<?php
require_once 'business.php';
require_once 'controller_utils.php';

function gallery(&$model) {
    $model['photos'] = [];
    $dir = './images';
    $scanned_dir = array_diff(scandir($dir), array('..', '.'));
    foreach ($scanned_dir as $plik) {
        $model['photos'][] = '<img src="' . $dir . '/' . $plik . '" alt="zdjęcie">';
    }
    return 'gallery_view';
}

function upload(&$model) {
    $model['result'] = '';
    $model['user'] = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES["file"])) {
            $file = $_FILES['file'];
            $error_code = checkFileConds($file);
            if ($error_code == 0) {
                $upload_status = doUpload($file);
                if ($upload_status == 0) {
                    $model['result'] = "Plik" . $file['name'] . " został przesłany pomyślnie.";
                    return 'upload_view';
                }
                else {
                    $model['result'] = 'upload_error';
                    return 'upload_view';
                }
            }
            else {
                $model['result'] = "<p style=\"color: red\">";
                /*
                $model['result'] .= match ($error_code) {
                    1 => "Plik jest za duży. Maksymalny rozmiar przesyłanego pliku to 1 MB.",
                    2 => "Niepoprawny format pliku.",
                    3 => "Niepoprawny format pliku.<br>Plik jest za duży. Maksymalny rozmiar przesyłanego pliku to 1 MB.",
                    4 => "Wystąpił błąd przy przesyłaniu pliku. Proszę spróbować później",
                };
                */
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