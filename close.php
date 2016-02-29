<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Auction Web Application | Place bid</title>
    <meta charset="utf-8"/>
    <link href="stylesheet.css" rel="stylesheet"/>
  </head>
  <body>
    <header>
      <span class="right">Billy is logged in</span>
      <span class="left"></span><a href="index.php"><h1>Auction Web Application</h1></a>
    </header>
    <nav>
      <ul>
        <li><a href="list.php">List item</a></li>
        <li><a href="active.php">Active Listings</a></li>
        <li><a href="bid.php">Browse Items</a></li>
        <li><a href="browse.php">Bids/Offers</a></li>
      </ul>
      <ul>
        <li><a href="browse.php">Browse items</a></li>
        <li class="next"><a href="close.php">Auction Closed</a></li>
      </ul>
      <hr/>
    </nav>
    <main>
      <form>
        <fieldset>
        <div>
          <h2>Auction Ended - <a href="pay.php">Pay Now</a></h2>
          <p class="right">Image of bevo plushie</p>
          <h2>Bevo Plushie</h2>
          <p>Sold by <a href="#">David</a></p>
          <b>Auction ended </b>
          <div>
            <label><b>Bid amount</b>: $</label>49.99<br/>
<!--            <input type="number"></input><br/>-->
<!--            <a href="bid-success.php">Submit</a>-->
          </div>
          <p><b>Category</b>: Home</p>
          <p><b>Condition</b>: New</p>
          <p><b>Item Description</b> Soft loveable plushie of Bevo. Machine washable. From a smoke-free, pet-free home.</p>
        </div>
        </fieldset>
      </form>
    </main>
    <footer>
      <hr/>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>
