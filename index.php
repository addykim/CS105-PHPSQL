<?php 
require_once '/u/askim/openDatabase.php';
$thisAuctionQuery = $database->prepare(<<<'SQL'
    SELECT  
        AUCTION_ID,
        CLOSE_TIME, 
        ITEM_CAPTION, 
        ITEM_PHOTO
    FROM AUCTION 
    WHERE STATUS = :auctionId;
SQL
);    
$thisAuctionQuery->bindValue(':auctionId', 1, PDO::PARAM_INT);
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
            <h2>Live Auctions</h2>
<?php
foreach ($thisAuctionQuery->fetchAll() as $auction) {
?>
                <div class="item-box">
                    <? if ($auction['ITEM_PHOTO'] == NULL): ?>
                        <p class="right">No Photo</p>
                    <? else: ?>
                        <span class="right"></span>
                        <!-- TODO add image -->
                    <? endif; ?>
                    <!-- TODO add active bid link -->
                    <a href="bid.php?id=<?= urlencode($auction['AUCTION_ID']); ?>">
                        <h3><?= $auction['ITEM_CAPTION'] ?></h3>
                    </a>
                        
                    <? if ($auction['AUCTION_STATUS'] == 1): ?>
                        <p><b>Auction ends at </b><?= $auction['CLOSE_TIME'] ?></p>
                    <? endif; ?>
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
