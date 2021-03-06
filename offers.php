<?php 
require_once '/u/askim/openDatabase.php';
$thisAuctionQuery = $database->prepare(<<<'SQL'
    SELECT 
        AUCTION_ID,
        STATUS, 
        SELLER, 
        OPEN_TIME, 
        CLOSE_TIME, 
        ITEM_CATEGORY, 
        ITEM_CAPTION, 
        ITEM_DESCRIPTION, 
        ITEM_PHOTO
    FROM AUCTION;

SQL
);    
// TODO add seller id
// $thisAuctionQuery->bindValue(':auctionStatus', 1, PDO::PARAM_INT);
$thisAuctionQuery->execute();
    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Auction Web Application | Active Listings</title>
    <meta charset="utf-8"/>
    <link href="stylesheet.css" rel="stylesheet"/>
  </head>
  <body>
    <header>
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
        <h2>Bids/Offers</h2>
<?php
foreach ($thisAuctionQuery->fetchAll() as $auction) {
?>
        <div class="item-box">
            <? if ($auction['ITEM_PHOTO'] == NULL): ?>
                <img src="https://pixabay.com/static/uploads/photo/2015/09/09/18/35/night-932424_960_720.jpg" class="stock-thumb right">
            <? else: ?>
                <span class="right"></span>
                <!-- TODO add image -->
            <? endif; ?>
            <a href="details.php?id=<?= urlencode($auction['AUCTION_ID']) ?>">
                <h3><?= $auction['ITEM_CAPTION'] ?></h3>
            </a>
        
        <table>

<?php
if ($auction['STATUS'] == 1) {
?>  
                <tr>
                    <td><b>Highest Bid</b></td>
                        <!-- TODO highest bid -->
                </tr>
                <tr>
                    <td><b>Auction Ends At</b></td>
                    <td><?= date( 'M-d h:i:s A', $auction['CLOSE_TIME']); ?></td>   
<?php
} elseif ($auction['STATUS'] == 2) {
?>
                    <td><b>Auction Cancelled</b></td>
<?php
} elseif ($auction['STATUS']== 3) {
?>
                <tr>
                    <td><b>Auction Won</b></td>
                    <td><a href="pay.php?id=<?= urlencode($auction['AUCTION_ID']); ?>&pay=23.22">Pay Now</a></td>
                </tr>
<?php
}
?>
            </tr>
        </table>

            <!-- TODO current highest bid -->
          </div>

<?php
}
$thisAuctionQuery->closeCursor();
?>
    </main>
    <footer>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>
