<?php
// if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== "on") {
//     header('HTTP/1.1 403 Forbidden: TLS Required');
//     // Optionally output an error page here
//     exit(1);
// }

require_once '/u/askim/openDatabase.php';

$item = $database->prepare(<<<'SQL'
    UPDATE AUCTION 
    SET
        STATUS = 2
    WHERE 
    AUCTION_ID = :auctionId;
SQL
);
$item->bindValue(':auctionId', $_GET['id'], PDO::PARAM_INT);

$execSuccess = $item->execute();

$item->closeCursor();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Auction Web Application | Update Listing</title>
    <meta charset="utf-8"/>
    <link href="stylesheet.css" rel="stylesheet"/>
  </head>
  <body>
    <header>
        <span class="right">Hello <a href="account.php"><?= htmlspecialchars($_SESSION['userName']) ?></a>!</span>
      <span class="left"></span><a href="index.php"><h1>Auction Web Application</h1></a>
      <ul>
        <li><a href="list.php">List item</a></li>
        <li><a href="active.php">Active Listings</a></li>
        <li><a href="browse.php">Browse Items</a></li>
        <li><a href="offers.php">Bids/Offers</a></li>
      </ul>
    </header>
  
    <main>

<?php
if ($execSuccess) {
?>
    <h2><a href="active.php">Active Listings</a> → Cancelled Successfully</h2>

<?php
} else {
?>     
    <h2><a href="active.php">Active Listings</a> → Cancel Failed</h2><p>Cancel Failed.</p>
<?php
}
?> 

    <!-- <div class="item-box"> -->
        
    <!-- </div> -->

    </main>
    <footer>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>