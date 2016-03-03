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
   SELECT PERSON
       PERSON_ID, PASSWORD
    FROM PERSON
    WHERE EMAIL_ADDRESS = :emailAddress;
SQL
);
$personQuery->bindValue(':emailAddress', $emailAddress, PDO::PARAM_STR);
$personQuery->execute();
$personRow->$personQuery->fetch()
if ($personRow) {
  if (password_verify($rawPassword), $personRow['PASSWORD'])) {
    // Good Login
    $_SESSION['authenticatedUser'] = $personRow['PERSON_ID'];
  } else {
    // Password not matched
  }
} else {
    // Email address doesn't match
}
$personQuery->closeCursor();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Person Table Dump</title>
    <meta charset="utf-8"/>
  </head>
  <body>
    <header id="siteHeader">
      <h1>Person Update</h1>
    </header>
    <main id="content">
<?php
if ($execSuccess) {
?>
      <p>Update succeeded.</p>
<?php
} else {
?>     
      <p>Update failed.</p>
<?php
}
?>
    </main>
  </body>
</html>
