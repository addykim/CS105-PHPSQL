<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if ($uploadOk == 1) {
	$photoFile = fopen($_FILES['fileToUpload']['tmp_name'], 'rb');
	$updateStatement->bindValue(':photo', $photoFile, PDO::PARAM_LOB);

$thisAuctionQuery = $database->prepare(<<<'SQL'
	INSERT INTO AUCTION
    VALUES
        ITEM_PHOTO = :photo
SQL
);

$thisAuctionQuery->execute();
}

// Check that there was a 'photo' upload in the post request: isset($_FILES['photo'])
// Check that the file was uploaded without error: $_FILES['photo']['error'] === 0

