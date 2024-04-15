<?php

declare(strict_types=1);

require_once('../database/connection.db.php');
//require_once('../database/comment.class.php');
require_once('../database/reply.class.php');


function fetchByCategory(PDO $dbh, String $Category ):array
{
  $stmt = $dbh->prepare('SELECT * FROM items WHERE category =?');
  $stmt->execute(array($Category));
  $items = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $items[] = new Item(
      $row['id'],
      $row['ownerUser'],
      $row['descriptionItem'],
      $row['sizeItem'],
      $row['price'],
      $row['brand'],
      $row['model'],
      $row['condition']
    );
  }
  return $items;
}

