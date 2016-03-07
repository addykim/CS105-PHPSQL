<?php
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== "on") {
    header('HTTP/1.1 403 Forbidden: TLS Required');
    // Optionally output an error page here
    exit(1);
}

session_start();

require_once '/u/askim/openDatabase.php';

$emailAddress = $_POST['emailAddress'];
$rawPassword = $_POST['password'];

$personQuery = $database->prepare(<<<'SQL'
   SELECT PERSON_ID, PASSWORD
   FROM PERSON
   WHERE EMAIL_ADDRESS = :emailAddress;
SQL
);

$personQuery->bindValue(':emailAddress', $emailAddress, PDO::PARAM_STR);
$personQuery->execute();

$queryStatus = $personQuery->execute();

if ($queryStatus) {
    $personRow = $personQuery->fetch();
    $hashedPassword = $personRow['PASSWORD'];
    $authenticationSucceeded = password_verify($rawPassword, $hashedPassword);
} else {
    // E-mail address didn't match
    $authenticationSucceeded = false;
}

if ($authenticationSucceeded) {
    $_SESSION['authenticatedUser'] = $personRow['PERSON_ID'];
} else {
    unset($_SESSION['authenticatedUser']);
}

$personQuery->closeCursor();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Login</title>
    <meta charset="utf-8"/>
  </head>
  <body>
    <header id="siteHeader">
      <h1>Login</h1>
    </header>
    <main id="content">
<?php
if ($_SESSION['authenticatedUser']) {
?>
      <p>Hello logged in user, you are PERSON_ID <?= $_SESSION['authenticatedUser'] ?>.</p>
<?php
} else {
?>     
      <p>Login failed.</p>
<?php
}
?>
    </main>
  </body>
</html>
