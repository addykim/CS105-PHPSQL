<?php
header('Content-Type: image/jpeg');
header('Content-Length: '.strlen($photoContents));
if (strlen($photoContents) == 0) {
    $photoContents = file_get_contents('noPhoto.jpg');
} else {
	echo $photoContents;	
}