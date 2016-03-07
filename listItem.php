<?php
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== "on") {
    header('HTTP/1.1 403 Forbidden: TLS Required');
    // Optionally output an error page here
    exit(1);
}

require_once '/u/askim/openDatabase.php';

$name = $_POST['name'];
$category = $_POST['category'];
$bid = $_POST['bid'];
$description = $_POST['description'];

$item = $database->prepare(<<<'SQL'
    INSERT INTO AUCTION (
        ITEM_CAPTION,
        CATEGORY,
        DESCRIPTION
        ) VALUES (
        :name,
        :category,
        :description
        );
SQL
);
$item->bindValue(':name', $name, PDO::PARAM_STR);
$item->bindValue(':category', $category, PDO::PARAM_INT);
$item->bindValue('description', $description, PDO::PARAM_STR);
;

$execSuccess = $item->execute();

$item->closeCursor();

// TODO bid
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
