<?php

declare(strict_types=1);
require_once('database/connection.db.php');

function register_user(PDO $dbh, string $username, string $password, string $name, $email): void
{
  $stmt = $dbh->prepare('INSERT INTO users VALUES (?, ?, ?, ?)');
  $stmt->execute(array($username, sha1($password), $name, $email));
}

function verify_user(PDO $dbh, string $username, string $password): bool
{
  $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
  $stmt->execute(array($username, sha1($password)));

  return $stmt->fetch() !== false;
}

function register_item(PDO $dbh, string $ownerUser, string $descriptionItem, string $sizeItem) : void 
{
  $stmt = $dbh->prepare('SELECT MAX(id) AS max_id FROM items');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $id = $row['max_id'] ?? 0;
  $id = $id + 1;

  $stmt = $dbh->prepare('INSERT INTO items VALUES (?, ?, ?, ?)');
  $stmt->execute(array($id,$ownerUser, $descriptionItem, $sizeItem));
}
