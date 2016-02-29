<?php 
require_once '/u/askim/openDatabase.php';
$thisAuctionQuery = $database->prepare(<<<'SQL'
    SELECT 
        SELLER, 
        CLOSE_TIME, 
        ITEM_CATEGORY, 
        ITEM_CAPTION, 
        ITEM_DESCRIPTION, 
        ITEM_PHOTO
    FROM AUCTION 
    WHERE AUCTION_ID = :auctionId;
SQL
);    

$thisAuctionQuery->bindValue(':auctionId',  $_GET['id'] , PDO::PARAM_INT);
$thisAuctionQuery->execute();
    
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
        <form>
        <h2><a href="browse.php">Browse Items</a> → Place Bid</h2>
        <div class="item-box">
<?php
$thisAuction = $thisAuctionQuery->fetch();
?>
            <? if ($thisAuction['ITEM_PHOTO'] == NULL): ?>
                <img src="https://pixabay.com/static/uploads/photo/2015/09/09/18/35/night-932424_960_720.jpg" class="stock-image right">
            <? else: ?>
                <!-- TODO add image -->
            <? endif; ?>
            <h2><?= $thisAuction['ITEM_CAPTION'] ?></h2>
            <!-- TODO change this to Seller name -->
            <table>

                <tr>
                    <td><b>Sold By</b></td>
                    <td><?= $thisAuction['SELLER'] ?></td>
                </tr>
                <tr>
                    <!-- TODO reformat this time -->
                    <!-- TODO have this countdown -->
                    <td><b>Auction Ends</b></td>
                    <td><?= date( 'M-d h:i:s A', $thisAuction['CLOSE_TIME']); ?> 
                </tr>
                <tr>
                    <td><b>Category</b></td>
                    <td><?= $thisAuction['ITEM_CATEGORY'] ?></td>
                </tr>
                <tr>
                    <td><b>Condition</b></td>
                    <!-- TODO grab this from database -->
                    <td>New</td>
                </tr>
                <tr>
                    <td><b>Item Description</b></td>
                    <td><?= $thisAuction['ITEM_DESCRIPTION'] ?></td>
                </tr>
            </table>
            <!-- TODO add submit button -->


            <input type="submit"></input>
        </div>
        </form>
<?php
$thisAuctionQuery->closeCursor();
?>
    </main>
    <footer>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>
