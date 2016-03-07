<?php 
require_once '/u/askim/openDatabase.php';
$auctionId = $_GET['id'];
$paymentAmount = $_GET['pay'];

$thisAuctionQuery = $database->prepare(<<<'SQL'
    SELECT 
        AUCTION_ID
    FROM AUCTION 
    WHERE AUCTION_ID = :auctionId;
SQL
);
$thisAuctionQuery->bindValue(':auctionId', $auctionId, PDO::PARAM_INT);
$thisAuctionQuery->execute();
    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>Auction Web Application | Pay for Auction</title>
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
            <h2><a href="offers.php">Bids/Offers</a> → Pay for Auction</h2>
            <div class="item-box">
                <form action="payment.php" method="post" enctype="multipart/form-data">
                    <table>
                        <input type="hidden" value="<?= $auctionId ?>" name="id">
                        <input type="hidden" value"<?= $paymentAmount ?>" name="amount">
                        <tr>
                            <td><b>Payment Owed</b></td>
                            <td><?= $paymentAmount ?></td>
                        </tr>
                        <tr>
                            <td><b>Credit Card Number</b></td>
                            <td><input type="text" name="card"></td>
                        <tr>
                            <td><b>
                        </tr>


                        </tr>
                        <tr>
                            <td><button type="submit">Submit</button></td>
                        </tr>
                    </table>
                </form>
            </div>

        </main>
        <footer>
          <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
          <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
        </footer>
    </body>
</html>
