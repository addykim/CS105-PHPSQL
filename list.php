<?php
require_once '/u/askim/openDatabase.php';
$thisAuctionQuery = $database->prepare(<<<'SQL'
    SELECT 
        AUCTION_ID 
    FROM AUCTION 
    WHERE AUCTION_ID=:auctionId;
SQL
);
$thisAuctionQuery->bindValue(':auctionId', $_GET['id'], PDO::PARAM_INT);
$thisAuctionQuery->execute();


$categories = $database->prepare(<<<'SQL'
    SELECT 
        ITEM_CATEGORY_ID,
        NAME 
    FROM ITEM_CATEGORY;
SQL
);
// TODO change seller data when using user data   
// $thisAuctionQuery->bindValue(':buyerId', 1, PDO::PARAM_INT);
$categories->execute();
// TODO close cursor eventually
 

// Check that there was a 'photo' upload in the post request: isset($_FILES['photo'])
// Check that the file was uploaded without error: $_FILES['photo']['error'] === 0
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Auction Web Application | List Item</title>
    <meta charset="utf-8"/>
    <link href="stylesheet.css" rel="stylesheet"/>
  </head>
  <body>
    <header>
        <!-- <p>Hello, <?= htmlspecialchars($_SESSION['userName']) ?>!</p> -->

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
        <!-- <? if ($uploadSuccess): ?> -->
            <!-- <h2><a href="list.php">List Item</a> → Item Listed Successfully</h2> -->
        <!-- <? else: ?> -->
            <h2>List Item</h2>
        <!-- <? endif; ?> -->
        
        <form action="library/listItem.php" method="post" enctype="multipart/form-data">
            <div class="item-box">
            <table>
                <tr>
                    <td><b>Upload Images</b></td>
                    <td><input type="file" name="photo" accept="image/jpeg"/></td>
                </tr> 
                <tr>
                    <td><b>Item Name</b></td>
                    <td><input type="text" name="name"></input></td>
                </tr>
                <tr>
                    <td><b>Category</b></td>
                    <td>
                        <select name="category">
<?php
foreach ($categories->fetchAll() as $category) {
?>
                            <option value="<?= $category['ITEM_CATEGORY_ID']?>"><?= $category['NAME'] ?></option>
<?php
}
$categories->closeCursor();
?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Starting Bid</b></td>
                    <td><input type="number" name="bid"></input></td>
                </tr>
                <tr>
                    <td><b>Item Description</b></td>
                    <td><input type="text" name="description"></input></td>
                </tr>
                <tr>
                    <td><b>Auction End Time</b></td>
                <!-- TODO enter time -->
                    <td><input type="datetime-local"></input></td>
                </tr>
            </table>
            <input type="hidden" name="id" value="<?= urlencode($auction['AUCTION_ID']); ?>"></input>
            <button type="submit">Submit</button>
                <!-- <input type="submit" name="listed"></input>    -->
            </div>

        <!-- TODO enter time submit button -->
        </form>

    </main>
    <footer>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>