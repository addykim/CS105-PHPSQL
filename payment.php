<?php
// if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== "on") {
//     header('HTTP/1.1 403 Forbidden: TLS Required');
//     // Optionally output an error page here
//     exit(1);
// }

require_once '/u/askim/openDatabase.php';

$buyerId = 1;
// TODO replace once login works
// $sellerId = $_SESSION['authenticatedUser'];
$auctionId = $_POST['id'];
$amount = $_POST['amount'];


$item = $database->prepare(<<<'SQL'
    INSERT PAYMENT (
        PERSON_ID,
        AMOUNT,
        AUCTION_ID
    ) VALUES (
        :buyerId,
        :amount,
        :auctionId
    );
SQL
);
$item->bindValue(':auctionId', $auctionId, PDO::PARAM_INT);
$item->bindValue(':buyerId', $buyerId , PDO::PARAM_INT);
$item->bindValue(':amount', $buyerId, PDO::PARAM_STR);

$execSuccess = $item->execute();

$item->closeCursor();

// TODO bid
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Auction Web Application | Place bid</title>
    <meta charset="utf-8"/>
    <link href="stylesheet.css" rel="stylesheet"/>
  </head>
  <body>

    <header>
    <!-- TODO replace with SQL query -->
        <!-- <p class="right">Hello <a href="account.php"> -->
            <!-- <?= $thisAccount['SURNAME'] ?> -->
        <!-- </a>!</p> -->
        <span class="right">Hello <a href="account.php">Billy</a>!</span>
        <span class="left"></span><a href="index.php"><h1>Auction Web Application</h1></a>
        <ul>
            <li><a href="list.php">List item</a></li>
            <li><a href="active.php">Active Listings</a></li>
            <li><a href="browse.php">Browse Items</a></li>
            <li><a href="offers.php">Bids/Offers</a></li>
        </ul>
    </header>
    <main> 
        <h2><a href="offers.php">Bids/Offers</a> → Pay for Auction</h2>
        <div class="item-box">
<?php
if ($execSuccess) {
?>
      <p>Payment succeeded.</p>
      <a href="offers.php">See Bids/Offers</a>
<?php
} else {
?>     
    <p>Payment failed.</p>
    <a href="list.php">Back</a>
<?php
}
?>
        </div>    
    </main>
    <footer>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>
