<?php 
require_once '/u/askim/openDatabase.php';
$thisAuctionQuery = $database->prepare(<<<'SQL'
    SELECT 
        AUCTION_ID,
        STATUS, 
        CLOSE_TIME, 
        ITEM_CATEGORY, 
        ITEM_CAPTION, 
        ITEM_PHOTO
    FROM AUCTION
    WHERE STATUS=1;
SQL
); 
$thisAuctionQuery->execute();
    

// TODO get user
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
        <h2>Browse Items</h2>  
        <label>Search by </label>
        <select>
          <option value="category">Category</option>
          <option value="keyword">Keyword</option>
          <option value="seller">Seller</option>
        </select>
        <input type="search"></input>
        <input type="button" value="Search"></input>
        <hr/>
  

<?php
foreach ($thisAuctionQuery->fetchAll() as $auction) {
?>
      <div class="item-box">
        <? if ($auction['ITEM_PHOTO'] == NULL): ?>
            <img src="https://pixabay.com/static/uploads/photo/2015/09/09/18/35/night-932424_960_720.jpg" class="stock-thumb right">
        <? else: ?>
            <span class="right"><img src="showPhoto.php?id=2" /></span>

            <!-- TODO add image -->
        <? endif; ?>      
        <a href="bid.php?id=<?= urlencode($auction['AUCTION_ID']); ?>">
            <h3><?= $auction['ITEM_CAPTION'] ?></h3>              
        </a>

        <table>
            <tr>
                <td><b>Highest Bid</b></td>
                        <!-- TODO highest bid -->
            </tr>
            <tr>
                 <td><b>Auction Ends</b></td>
                <td><?= $auction['CLOSE_TIME'] ?></td>
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
