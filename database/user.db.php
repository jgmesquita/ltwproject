<?php

declare(strict_types=1);
require_once('../database/connection.db.php');

function register_user(PDO $dbh, string $username, string $password, string $firstName, string $lastName, string $address_, string $city, string $country, string $postalCode, string $email, string $phone): void
{
  if (!user_exist($dbh, $username)) {
    $stmt = $dbh->prepare('INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($username, sha1($password), $firstName, $lastName, $address_, $city, $country, $postalCode, $email, $phone));
  }
  else {
    header('Location: /pages/where.php');
  }
}

function user_exist(PDO $dbh, string $username): bool {
  $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
  $stmt->execute(array($username));
  return $stmt->fetch() !== false;
}

function verify_user(PDO $dbh, string $username, string $password): bool
{
  $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ? AND pw = ?');
  $stmt->execute(array($username, sha1($password)));
  return $stmt->fetch() !== false;
}

function register_item(PDO $dbh, string $ownerUser, string $descriptionItem, string $sizeItem, int $price, string $brand, string $model, string $condtion) : void 
{
  $stmt = $dbh->prepare('SELECT MAX(id) AS max_id FROM items');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $id = $row['max_id'] ?? 0;
  $id = $id + 1;

  $stmt = $dbh->prepare('INSERT INTO items VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
  $stmt->execute(array($id, $ownerUser, $descriptionItem, $sizeItem, $price, $brand, $model, $condtion));
}

function getItem(PDO $dbh, int $id) : Item {
  $stmt = $dbh->prepare('SELECT * FROM items WHERE id = ?');
  $stmt->execute(array($id));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $item = new Item(
    $row['id'],
    $row['ownerUser'],
    $row['descriptionItem'],
    $row['sizeItem'],
    $row['price'],
    $row['brand'],
    $row['model'],
    $row['condition']
  );
  return $item;
}
