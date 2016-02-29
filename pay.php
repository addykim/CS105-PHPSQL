<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Auction Web Application | Pay for Purchase</title>
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
        <li><a href="active.php">Browse Listings</a></li>
        <li><a href="browse.php">Buy item</a></li>
        <li><a href="offers.php">Bids/Offers</a></li>
      </ul>
      <ul>
        <li><a href="browse.php">Browse items</a></li>
        <li class="next"><a href="close.php">Auction Closed</a></li>
        <li class="next">Pay for Purchase</li>
      </ul>
      <hr/>
    </nav>
    <main class="clear">
      <form>
        <fieldset>
          <p>Your total is $10.00 for Bevo Plushie</p>
          <p>Enter billing information:</p>
          <div>
            <label><b>Name</b></label>
            <input type="text"></input>
          </div>
          <div>
            <label><b>Credit card Number</b></label>
            <input type="number"></input>
          </div>
          <div>
            <label><b>Expr. Date</b></label>
            <input type="text"></input><br/>
          </div>
          <a href="pay-success.php">Submit</a>
        </fieldset>
      </form>
    </main>
    <div>
      <!-- TODO this might not properly validate -->
        <fieldset>
          <h2>Payment Success</h2>
          
          <p>Your total is $10.00 for Bevo Plushie</p>
          <p>Enter billing information:</p>
          <div>
            <p><b>Name</b>: Billy </p>
            <p><b>Credit Card Number</b>: xxxx xxxx xxxx 3333</p>
            <p><b>Expiration Date</b> 10/20</p>
          </div>
        </fieldset>
      </div>
    <footer>
      <hr/>
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>
