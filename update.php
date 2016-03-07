<?php
require_once '/u/askim/openDatabase.php';

$auctionId = $_GET['id'];

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
        ITEM_PHOTO,
        STARTING_BID
    FROM AUCTION 
    WHERE AUCTION_ID = :auctionId;
SQL
);    

$thisAuctionQuery->bindValue(':auctionId',  $auctionId, PDO::PARAM_INT);
$thisAuctionQuery->execute();

$categories = $database->prepare(<<<'SQL'
    SELECT 
        ITEM_CATEGORY_ID,
        NAME 
    FROM ITEM_CATEGORY;
SQL
);
$categories->execute();
    
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
        <h2><a href="active.php">Active Listings</a> → Update Listing</h2>

<?php
$thisAuction = $thisAuctionQuery->fetch();

?>
      <form>
            <div class="item-box">
                <!-- <h2><?= $thisAuction['ITEM_CAPTION'] ?></h2> -->
                <? if ($thisAuction['ITEM_PHOTO'] == NULL): ?>
                    <img src="https://pixabay.com/static/uploads/photo/2015/09/09/18/35/night-932424_960_720.jpg" class="stock-image right">
                <? else: ?>
                    <!-- TODO add image -->
                <? endif; ?>
            
            <table>
                <tr>
                    <td><b>Upload Images</b></td>
                    <td><input type="file"></input></td>
                </tr> 
                <tr>
                    <td><b>Item Name</b></td>
                    <!-- TODO fix it so category shows up instead of number -->
                    <td><input type="text" value="<?= $thisAuction['ITEM_CAPTION'] ?>"></input></td>
                </tr>
                <tr>
                    <td><b>Category</b></td>
                    <td>
                    <select>
<?php
foreach ($categories->fetchAll() as $category) {
?>
                <option 
                    value="<?= $category['ITEM_CATEGORY_ID']?>" 
                    selected="
                    <? if ($thisAuction['ITEM_CATEGORY_ID'] == $category['ITEM_CATEGORY_ID']): ?>
                        selected
                    <? endif; ?>
                    ">
                    <?= $category['NAME'] ?></option>
<?php
}
$categories->closeCursor();
?>  
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Starting Bid</b></td>
                    <td><p><?= $thisAuction['STARTING_BID'] ?></p></td>
                </tr>
                <!-- <tr> -->
                    <!-- <td><b>Reserved Bid</b></td> -->
                    <!-- TODO replace this number -->
                    <!-- <td><input type="number"></input></td> -->
                <!-- </tr> -->
                <tr>
                    <td><b>Auction End Time</b></td>
                    <!-- TODO format time -->
                    <td><?= $thisAuction['CLOSE_TIME'] ?></td>
                </tr>
                <tr>
                    <td><b>Item Description</b></td>
                    <td><input type="text" class="text-input" value="<?= $thisAuction['ITEM_DESCRIPTION'] ?>"></input></td>
                </tr>
                
                <input type="hidden" name="id" value="<?= htmlspecialchars($thisAuction['AUCTION_ID']) ?>" />
            </table>
            <input type="submit"></input>

        <!-- TODO enter time submit button -->

            </div>

<?php
$thisAuctionQuery->closeCursor();
$bidQuery->closeCursor();
?>
      </form>
    </main>
    <footer>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>
