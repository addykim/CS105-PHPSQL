<?php
// if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== "on") {
//     header('HTTP/1.1 403 Forbidden: TLS Required');
//     // Optionally output an error page here
//     exit(1);
// }

require_once '/u/askim/openDatabase.php';

$sellerId = 1;
// TODO replace once login works
// $sellerId = $_SESSION['authenticatedUser'];
$name = $_POST['name'];
$category = $_POST['category'];
$bid = $_POST['bid'];
$description = $_POST['description'];

$newIdQuery = $database->prepare('SELECT NEXT_SEQ_VALUE(:seqGenName);');
$newIdQuery->bindValue(':seqGenName', 'ITEM_CATEGORY', PDO::PARAM_STR);
$newIdQuery->execute();
$newItemId = $newIdQuery->fetchColumn(0);
$newIdQuery->closeCursor();

$item = $database->prepare(<<<'SQL'
    UPDATE AUCTION 
    SET
        ITEM_CAPTION        = :name,
        ITEM_CATEGORY       = :category,
        ITEM_DESCRIPTION    = :description
    WHERE 
    AUCTION_ID = :auctionId;
SQL
);
$item->bindValue(':auctionId', $newItemId, PDO::PARAM_INT);
$item->bindValue(':sellerId', $sellerId , PDO::PARAM_INT);
$item->bindValue(':name', $name, PDO::PARAM_STR);
$item->bindValue(':category', $category, PDO::PARAM_INT);
$item->bindValue(':description', $description, PDO::PARAM_STR);
$item->bindValue(':status', 1, PDO::PARAM_STR);

// TODO insert photos
$execSuccess = $item->execute();

$item->closeCursor();

// TODO bid
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
        <title>Auction Web Application | Pay for Auction</title>
        <meta charset="utf-8"/>
        <link href="stylesheet.css" rel="stylesheet"/>
      </head>
      <body>
        <header>
          <span class="right"><a href="login.php">Register or Login</a></span>
          <span class="center"></span><a href="index.php"><h1>Auction Web Application</h1></a>
          <ul>
            <li><a href="list.php">List item</a></li>
            <li><a href="active.php">Active Listings</a></li>
            <li><a href="bid.php">Browse Items</a></li>
            <li><a href="browse.php">Bids/Offers</a></li>
          </ul>
        </header>
        <main>
            <h2><a href="active.php">Active Listings</a> → Update Listing</h2>
            <div class="item-box">
<?php
if ($execSuccess) {
?>
      <p>Update succeeded.</p>
      <a href="active.php">See Active Listings</a>
<?php
} else {
?>     
    <p>Update failed.</p>
    <a href="list.php">Back</a>
<?php
}
?>
    </main>
    <footer class="clear">
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>