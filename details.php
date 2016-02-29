<?php 
require_once '/u/askim/openDatabase.php';
$thisAuctionQuery = $database->prepare(<<<'SQL'
    SELECT  
        SELLER,
        CLOSE_TIME,
        ITEM_CAPTION,
        ITEM_CATEGORY,
        ITEM_DESCRIPTION
    FROM AUCTION
    WHERE AUCTION_ID = :auctionId;
SQL
);    
$thisAuctionQuery->bindValue(':auctionId', $_GET['id'], PDO::PARAM_INT);
$thisAuctionQuery->execute();
    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>Auction Web Application | Item Details</title>
        <meta charset="utf-8"/>
        <link href="stylesheet.css" rel="stylesheet"/>
      </head>
      <body>
        <header>
          <span class="right">Hello <a href="account.php">Billy</a>!</span>
          <span class="center"></span><a href="index.php"><h1>Auction Web Application</h1></a>
          <ul>
            <li><a href="list.php">List item</a></li>
            <li><a href="active.php">Active Listings</a></li>
            <li><a href="bid.php">Browse Items</a></li>
            <li><a href="browse.php">Bids/Offers</a></li>
          </ul>
        </header>

    <main>
        <!-- TODO what is header that goes here -->
        <h2>Item Details</h2>
        <div class="item-box">
<?php
$thisAuction = $thisAuctionQuery->fetch();
?>
            <? if ($thisAuction['ITEM_PHOTO'] == NULL): ?>
                <img src="https://pixabay.com/static/uploads/photo/2015/09/09/18/35/night-932424_960_720.jpg" class="stock-image right">
            <? else: ?>
                <!-- TODO add image -->
                <!-- <img src="" class="image right"> -->
            <? endif; ?>
            <h2><?= $thisAuction['ITEM_CAPTION'] ?></h2>
            <!-- TODO change this to Seller name -->
            <table>
                <tr>
                    <td><b>Sold By </b></td>
                    <td><?= $thisAuction['SELLER'] ?></td>
                </tr>
                <tr>
                    <td><b>Auction Ends</b></td>
                    <td><?= $thisAuction['CLOSE_TIME'] ?></td>
                </tr>
                <tr>
                    <td><b>Bid amount</b></td>
                <!-- <input type="number"></input><br/> -->
                <!-- <a href="bid-success.php">Submit</a> -->
                </tr>
                <tr>
                    <td><b>Category</b></td>
                    <!-- TODO replace this with the item category -->
                    <td><?= $thisAuction['ITEM_CATEGORY'] ?></td>
                </tr>
            </table>
            <input type="submit"></input>
<?php
$thisAuctionQuery->closeCursor();
?>
        </div>
        </main>
        <footer>
          <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
          <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
        </footer>
    </body>
</html>
