<?php
// ini_set("display_errors", "1");
// error_reporting(E_ALL);
// resizing image
// usage
// rsz.php?url=hor.jpg&longest=1200

// starting
// header("Content-Type: text/html; charset=utf-8");
// echo '<pre>';

header('Content-Type: image/jpeg');
set_time_limit(30);
$mtime = microtime(true);

$img = resize_image($_GET['url'], $_GET['longest']);
imagejpeg($img, null, 100);
imagedestroy($img);

function resize_image($file, $longest) {
	list($w, $h) = getimagesize($_GET['url']);
	if ($w >= $h) {
		$r = $longest / $w;
		$newwidth = $w*$r;
		$newheight = $h*$r;
	} else {
		$r = $longest / $h;
		$newwidth = $w*$r;
		$newheight = $h*$r;
	}
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);

    return $dst;
}
?>