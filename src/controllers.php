<?php
require_once 'business.php';
require_once 'controller_utils.php';

function gallery(&$model) {
    $model['photos'] = [];
    $dir = './images';
    $scanned_dir = array_diff(scandir($dir), array('..', '.'));
    foreach ($scanned_dir as $plik) {
        $model['photos'] = '<img src="' . $dir . '/' . $plik . '" alt="zdjęcie">';
    }
    return 'gallery_view';
}

function upload(&$model) {

}

function login(&$model) {

}

function register(&$model) {

}