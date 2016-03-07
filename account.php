<?php
require_once '/u/askim/openDatabase.php';
$thisAccountQuery = $database->prepare(<<<'SQL'
    SELECT 
        PERSON_ID,
        SURNAME,
        FORENAME,
        EMAIL_ADDRESS
    FROM PERSON
    WHERE PERSON_ID = :personId;
SQL
);    
$thisAccountQuery->bindValue(':personId', $_GET['id'], PDO::PARAM_INT);
$thisAccountQuery->execute();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Auction Web Application | Account Information</title>
    <meta charset="utf-8"/>
    <link href="stylesheet.css" rel="stylesheet"/>
  </head>
  <body>
<?php
$thisAccount = $thisAccountQuery->fetch();
?>
    <header>
    <!-- TODO change -->
          <span class="right">Hello <a href="account.php">Billy</a>!</span>
        </a>!</p>
        <span class="left"></span><a href="index.php"><h1>Auction Web Application</h1></a>
      <ul>
        <li><a href="list.php">List item</a></li>
        <li><a href="active.php">Browse Listings</a></li>
        <li><a href="bid.php">Buy item</a></li>
        <li><a href="browse.php">Bids/Offers</a></li>
      </ul>
      <ul class="breadcrumb">
        <li>Account Information</li>
      </ul>
    </header> 
    <main>
    <h2>Account Information</h2>

    <p><b>Name</b>: <?= $thisAccount['SURNAME'] ?> <?= $thisAccount['FORENAME'] ?></p>
    <p><b>Email</b>: <?= $thisAccount['EMAIL_ADDRESS'] ?></p>

<!-- TODO up date password -->
<?php
$thisAccountQuery->closeCursor();
?>      
    </main>
    <footer>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>