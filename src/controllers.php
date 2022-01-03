<?php
require_once 'business.php';
require_once 'controller_utils.php';

function gallery(&$model) {
    if (!isset($_SESSION['remembered']))
        $_SESSION['remembered'] = [];
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $photosperpage = 3;
        $model['photos'] = [];
        $model['user'] = '';
        $dir_t = './images/thumbnails';
        $dir_w = './images/watermark';
        $photos = getPhotos();
        $addrs_t = [];
        $addrs_w = [];
        foreach ($photos as $photo) {
            $model['photos'][] = $photo;
            $addrs_t[] = getAddr($dir_t, $photo['name']);
            $addrs_w[] = getAddr($dir_w, $photo['name'] . '_watermark.png');
        }
        $model['addr']['thumb'] = $addrs_t;
        $model['addr']['wm'] = $addrs_w;
        $model['totalpages'] = ceil(count($model['photos']) / $photosperpage);
        $model['photosperpage'] = $photosperpage;
        if (isset($_GET['page'])) {
            $model['page'] = $_GET['page'];
            $model['page'] = max($model['page'], 1);
            $model['page'] = max(1, min($model['page'], $model['totalpages']));
        } else $model['page'] = 1;
        return 'gallery_view';
    } else {
        if (isset($_POST['remember'])) {
            $remembered = $_POST['remember'];
            foreach ($remembered as $photo) {
                $_SESSION['remembered'][] = $photo;
            }
        }
        $page = $_GET['page'] ?? 1;
        return 'redirect:gallery?page=' . $page;
    }
}

function upload(&$model) {
    $model['result'] = '';
    $model['user'] = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES["file"])) {
            $file = $_FILES['file'];
            $author = $_POST['author'] ?? '';
            $title = $_POST['title'] ?? '';
            $watermark = $_POST['watermark'];
            $error_code = checkFileConds($file);
            if ($error_code == 0) {
                $upload_status = doUpload($file);
                if ($upload_status == 0) {
                    $model['result'] = "Plik " . $file['name'] . " został przesłany pomyślnie.";
                    createThumbnail($file, $_SERVER["DOCUMENT_ROOT"]);
                    createWatermark($file, $_SERVER["DOCUMENT_ROOT"], $watermark);
                    saveImgInfo($file['name'], $author, $title);
                    return 'upload_success';
                }
                else {
                    $model['result'] = 'Wystąpił błąd przy przesyłaniu pliku. Prosimy spróbować później.';
                    return 'upload_view';
                }
            }
            else {
                switch ($error_code) {
                    case 1:
                        $model['result'] = "Plik jest za duży. Maksymalny rozmiar przesyłanego pliku to 1 MB.";
                        break;
                    case 2:
                        $model['result'] = "Niepoprawny format pliku. Proszę wybrać plikw formacie JPEG lub PNG.";
                        break;
                    case 3:
                        $model['result'] = "Niepoprawny format pliku. Proszę wybrać plikw formacie JPEG lub PNG.<br>Plik jest za duży. Maksymalny rozmiar przesyłanego pliku to 1 MB.";
                        break;
                    case 4:
                        $model['result'] = "Wystąpił błąd przy przesyłaniu pliku. Proszę spróbować później.";
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
    if (!empty($_SESSION['user_id'])) {
        $model['user'] = getUserById($_SESSION['user_id']);
    } else {
        $model['user'] = '';
    }
    return 'upload_view';
}

function login(&$model) {
    $model['result'] = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if (readUser($username, $password)) {
                $model['result'] = 'Zalogowano pomyślnie';
                return 'login_success';
            } else {
                $model['result'] = 'Nie znaleziono użytkownika o podanych danych.';
                return 'login_view';
            }
        } else {
            return 'redirect:/login';
        }
    } else {
        return 'login_view';
    }
}

function register(&$model) {
    $model['result'] = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rep_password']) && isset($_POST['email_addr'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rep_password = $_POST['rep_password'];
            $email = $_POST['email_addr'];
            $free = isUsernameFree($username);
            if ($free === true) {
                if ($password === $rep_password) {
                    if (addUser($email, $username, $password) === 0) {
                        return 'register_success';
                    } else {
                        $model['result'] = 'Wystąpił nieznany problem. Proszę spróbować później.';
                        return 'register_view';
                    }
                } else {
                    $model['result'] = 'Hasła nie są jednakowe.';
                    return 'register_view';
                }
            } elseif ($free === false) {
                $model['result'] = 'Nazwa użytkownika jest zajęta.';
                return 'register_view';
            } else {
                $model['result'] = 'Wystąpił nieznany problem. Proszę spróbować później.';
                return 'register_view';
            }
        } else {
            return 'redirect:/register';
        }
    } else {
        return 'register_view';
    }
}

function logout(&$model) {
    session_destroy();
    session_unset();
    session_start();

    return 'logout_view';
}
