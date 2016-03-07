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

$categories = $database->prepare(<<<'SQL'
    SELECT 
        NAME 
    FROM ITEM_CATEGORY
    WHERE ITEM_CATEGORY_ID = :itemCategory;
SQL
);

$thisAuction = $thisAuctionQuery->fetch();
$categories->bindValue(':itemCategory', $thisAuction['ITEM_CATEGORY'], PDO::PARAM_INT);
$categories->execute();

$sellers = $database->prepare(<<<'SQL'
    SELECT 
        FORENAME
    FROM PERSON
    WHERE PERSON_ID = :auctionId;
SQL
);
$sellers->bindValue(':auctionId', $_GET['id'], PDO::PARAM_INT);
$sellers->execute();


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
            <h2><?= $thisAuction['ITEM_CAPTION'] ?></h2>
            <? if ($thisAuction['ITEM_PHOTO'] == NULL): ?>
                <img src="https://pixabay.com/static/uploads/photo/2015/09/09/18/35/night-932424_960_720.jpg" class="stock-image right">
            <? else: ?>
                <!-- TODO add image -->
                <!-- <img src="" class="image right"> -->
            <? endif; ?>

            <table>
                <tr>
<?php 
$seller = $sellers->fetch();
?>
                    <td><b>Sold By </b></td>
                    <td><?= $seller['FORENAME'] ?></td>
<?php
$sellers->closeCursor();
?>
                </tr>
                <tr>
                    <td><b>Auction Ends</b></td>
                    <td><?= date( 'M-d h:i:s A', $auction['CLOSE_TIME']); ?></td>
                </tr>
                <tr>
                    <td><b>Bid amount</b></td>
                <!-- <input type="number"></input><br/> -->
                <!-- <a href="bid-success.php">Submit</a> -->
                </tr>
                <tr>
                    <td><b>Category</b></td>
<?php
$category = $categories->fetch();
?>
                    <td><?= $category['NAME'] ?></td>
<?php
$categories->closeCursor();
?>
                
                </tr>
                <tr>
                    <td><b>Item Description</b></td>
                    <td><?= $thisAuction['ITEM_DESCRIPTION'] ?></td>
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
