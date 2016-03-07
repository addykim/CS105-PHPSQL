<!-- Change to accomodate bids -->

<?php
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== "on") {
    header('HTTP/1.1 403 Forbidden: TLS Required');
    // Optionally output an error page here
    exit(1);
}

require_once '/u/jthywiss/ai/cs105_2016spring/TyEPZG4HICNhgGGTKoljNIBPRQe67GJ/openDatabase.php';

$currentPersonId = $_POST['personId'];
$newForename = $_POST['forename'];
$newSurname = $_POST['surname'];
$newEmailAddress = $_POST['emailAddress'];
$rawPassword = $_POST['password'];
$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);
unset($rawPassword);

$personUpdate = $database->prepare(<<<'SQL'
   UPDATE PERSON
       SET
           FORENAME      = :newForename,
           SURNAME       = :newSurname,
           EMAIL_ADDRESS = :newEmailAddress,
           PASSWORD      = :hashedPassword
       WHERE PERSON_ID = :currentPersonId;
SQL
);
$personUpdate->bindValue(':newForename', $newForename, PDO::PARAM_STR);
$personUpdate->bindValue(':newSurname', $newSurname, PDO::PARAM_STR);
$personUpdate->bindValue(':newEmailAddress', $newEmailAddress, PDO::PARAM_STR);
$personUpdate->bindValue(':currentPersonId', $currentPersonId, PDO::PARAM_INT);
$personUpdate->bindValue(':hashedPassword', $hashedPassword, PDO::PARAM_STR);

$execSuccess = $personUpdate->execute();

$personUpdate->closeCursor();
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
