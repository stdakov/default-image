<?php
chdir(dirname(__FILE__));
require '../vendor/autoload.php';
require_once('../src/helper/functions.php');

$actualLink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = parse_url($actualLink, PHP_URL_PATH);
$url = trim($url, '/');

$params = explode('x', $url);

$width = 0;
$height = 0;
$action = '';
list($action) = $params;

if (count($params) >= 1) {
    list($width, $height) = $params;
}

if (isset($_POST['width']) && isset($_POST['height'])) {
    $width = (int)$_POST['width'];
    $height = (int)$_POST['height'];

    header('Location: /' . $width . 'x' . $height);
    exit(1);
}

if (($width > 0 || $height > 0) && $width < 1000 && $height < 1000) {

    if ($width == 0) {
        $width = $height;
    }

    if ($height == 0) {
        $height = $width;
    }

    $generator = new \App\Service\ImageGenerator(__DIR__);

    $img = $generator->setWidth($width)->setHeight($height)->generate();

    showImage($img);

    exit(1);
}

if ($action == 'images') {
    $files = scandir('media/storage');
    $images = [];
    foreach ($files as $filename) {
        if ($filename != '.' && $filename != '..') {
            $label = '';
            $images[] = [
                'label' => $label,
                'file' => $filename
            ];
        }
    }
    include_once('view/gallery.php');
} else {
    include_once('view/index.php');
}
