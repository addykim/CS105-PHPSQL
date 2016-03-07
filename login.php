<?php
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== "on") {
    header('Location: https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
    exit(1);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Auction Web Application | Register or Login</title>
    <meta charset="utf-8"/>
    <link href="stylesheet.css" rel="stylesheet"/>
  </head>
  <body>
    <header>
      <span class="right"><a href="login.php">Register or Login</a></span>
      <span class="left"></span><a href="index.php"><h1>Auction Web Application</h1></a>
      <ul>
        <li><a href="list.php">List item</a></li>
        <li><a href="active.php">Active Listings</a></li>
        <li><a href="browse.php">Browse Items</a></li>
        <li><a href="offers.php">Bids/Offers</a></li>
      </ul>
    </header>
    <main>
      <div class="left half-width">
        <h2>Don't have an account? <br/>Register</h2>
        <p>
          <label for="forename">Forename</label>
          <input type="text"></input>
        </p>
        <p>
          <label for="surname=">Surname</label>
          <input type="text"></input>

          <label for="password"><b>Password</b></label>
          <input type="password"></input>
        </p>
        <p>
          <label for="emailAddress"><b>E-mail Address</b></label>
          <input type="text"></input>
        </p>
        <div id="term-condition">
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
          <p>Lorem Ipsum from <a href="lipsum.com">Here</a></p>
        </div>
        <input type="checkbox"></input><label>I agree to the terms and conditions</label><br/>
        <a href="register-success.php">Submit</a>
      </div>

      <form action="authenticate.php" method="post" enctype="multipart/form-data" class="right half-width">
        <h2>Login</h2>
        <p><label for="emailAddress">E-mail Address: </label><input type="email" name="emailAddress"/></p>
        <p><label for="password">Password: </label><input type="password" name="password"/></p>
        <p><button>Login</button></p>
      </form>
    </main>
    <footer class="clear">
      <p><a href="static/acme.php">About Acme</a> | <a href="static/help.php">Help</a> | <a href="static/contact.php">Contact us</a></p>
      <p>© 2016 Acme Auctions, Inc. All rights reserved.</p>
    </footer>
  </body>
</html>