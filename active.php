<?php 
require_once '/u/askim/openDatabase.php';
$thisAuctionQuery = $database->prepare(<<<'SQL'
    SELECT 
        AUCTION_ID,
        STATUS, 
        CLOSE_TIME, 
        ITEM_CATEGORY, 
        ITEM_CAPTION, 
        ITEM_DESCRIPTION, 
        ITEM_PHOTO
    FROM AUCTION
    WHERE 
        STATUS = 1 AND
        SELLER = :sellerId;
SQL
);    
// TODO change seller id when using user data
$thisAuctionQuery->bindValue(':sellerId', 1, PDO::PARAM_INT);
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
        <!-- TODO add authenticated user id  -->
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
        <h2>Active Listings</h2>
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
            <a href="details.php?id=<?= urlencode($auction['AUCTION_ID']); ?>"> 
                <h3><?= $auction['ITEM_CAPTION'] ?></h3>
            </a>
            <table>
            
                <tr>
                    <td><b>Auction Ends At</b></td>
                    <td><?= date( 'M-d h:i:s A', $auction['CLOSE_TIME']); ?></td>
                </tr>
                <tr>
                    <td><a href="update.php?id=<?= urlencode($auction['AUCTION_ID']) ?>">Update</a></td>
                    <td><a href="cancel.php?id=<?= urlencode($auction['AUCTION_ID']) ?>">Cancel</a></td>
                </tr>
                
            </table>
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
