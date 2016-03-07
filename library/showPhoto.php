<?php
require_once '/u/askim/openDatabase.php';
$photoContents = $database->prepare(<<<'SQL'
	SELECT 
		ITEM_PHOTO
	FROM AUCTION
    WHERE AUCTION_ID=:auctionId;
SQL
); 
$photoContents->bindValue(':auctionId', $_GET['id'], PDO::PARAM_INT);

header('Content-Type: image/jpeg');
header('Content-Length: '.strlen($photoContents));
if (strlen($photoContents) == 0) {
    $photoContents = file_get_contents('noPhoto.jpg');
} else {
	echo $photoContents;	
}