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
    <title>Auction Web Application | Cancel Listing</title>
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
      <form>
           <? if (isset($_SESSION['listed']): ?>
                <h2><a href="active.php">Active Listings</a> → Cancel Listing → Listing Cancelled Successfully</h2>  
          <? else: ?>
              <h2><a href="active.php">Active Listings</a> → Cancel Listing</h2>
          <? endif; ?>

<!-- TODO code to actually cancel the listing-->
        <div class="item-box">
<?php
$thisAuction = $thisAuctionQuery->fetch();
?>
          <? if ($thisAuction['STATUS'] == 2): ?>
            <h2>Auction Cancelled</h2>
          <? endif; ?>
          <? if ($thisAuction['ITEM_PHOTO'] == NULL): ?>
              <img src="https://pixabay.com/static/uploads/photo/2015/09/09/18/35/night-932424_960_720.jpg" class="stock-image right">
          <? else: ?>

              <!-- TODO add image -->
              <!-- <img src="" class="image right"> -->
          <? endif; ?>
          <h2><?= $thisAuction['ITEM_CAPTION'] ?></h2>
            <table> 
                <tr>
                    <td><b>Category</b></td>
                    <!-- TODO change category from number -->
                    <td><p><?= $thisAuction['ITEM_CATEGORY'] ?></p></td> 
                </tr>
                <tr>
                    <td><b>Starting Bid</b></td>
                    <!-- TODO replace this number -->
                    <!-- <td><input type="number" value="30"></input></td> -->
                </tr>
                <tr>
                    <td><b>Reserved Bid</b></td>
                    <!-- TODO replace this number -->
                    <!-- <td><input type="number"></input></td> -->
                </tr>
                <tr>
                    <td><b>Auction End Time</b></td>
                    <!-- TODO format time -->
                    <td><?= $thisAuction['CLOSE_TIME'] ?></td>
                </tr>
                                <!-- TODO grab description -->
                <tr>
                    <td><b>Item Description</b></td>
                    <td><p><?= $thisAuction['ITEM_DESCRIPTION'] ?></p></td>
                </tr>
                
            </table>
                    <input type="submit"></input>
        <!-- TODO enter time submit button -->

            </div>
        </div>
      </form>
    </main>
    <footer>
      <hr/>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>
