<?php

declare(strict_types=1);

require_once('../database/connection.db.php');

require_once('../database/comment.class.php');

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

function user_exist(PDO $dbh, string $username): bool 
{
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

function change_username(PDO $dbh, string $username, string $new_username): bool 
{
  $stmt = $dbh->prepare('UPDATE users SET username = ? WHERE username = ?');
  $status = $stmt->execute(array($new_username, $username));
  return $status;
}

function change_name(PDO $dbh, string $username, string $new_firstName, string $new_lastName): bool 
{
  $stmt = $dbh->prepare('UPDATE users SET firstName = ?, lastName = ? WHERE username = ?');
  $status = $stmt->execute(array($new_firstName, $new_lastName, $username));
  return $status;
}
function change_email(PDO $dbh, string $username, string $new_email): bool 
{
  $stmt = $dbh->prepare('UPDATE users SET email = ? WHERE username = ?');
  $status = $stmt->execute(array($new_email, $username));
  return $status;
}
function change_password(PDO $dbh, string $username, string $new_password): bool 
{
  $stmt = $dbh->prepare('UPDATE users SET pw = ? WHERE username = ?');
  $status = $stmt->execute(array(sha1($new_password), $username));
  return $status;
}

function is_admin(PDO $dbh, string $username): bool
{
  $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
  $stmt->execute(array($username));
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

function check_listed_items(PDO $dbh, string $username) : array 
{
  $stmt = $dbh->prepare('SELECT * FROM items WHERE ownerUser = ?');
  $stmt->execute(array($username));
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

function check_wishlist_items(PDO $dbh, string $username) : array 
{
  $stmt = $dbh->prepare('SELECT items.* FROM items JOIN wishlist ON items.id = wishlist.id WHERE wishlist.user = ?');
  $stmt->execute(array($username));
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

function add_wishlist(PDO $dbh, string $username, int $id) : void 
{
  $stmt = $dbh->prepare('INSERT INTO wishlist VALUES (?, ?)');
  $stmt->execute(array($id, $username));
}

function remove_wishlist(PDO $dbh, string $username, int $id) : void 
{
  $stmt = $dbh->prepare('DELETE FROM wishlist WHERE id = ? AND user = ?');
  $stmt->execute(array($id, $username));
}

function is_wishlist_item(PDO $dbh, string $username, int $id) : bool
{
  $stmt = $dbh->prepare('SELECT * FROM wishlist WHERE id = ? AND user = ?');
  $stmt->execute(array($id, $username));
  return $stmt->fetch() !== false;
}

function get_item(PDO $dbh, int $id) : Item 
{
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

function get_comments(PDO $dbh, int $id) : array
{
  $stmt = $dbh->prepare('SELECT comment.* FROM items JOIN comment ON comment.idItem = items.id WHERE items.id = ?');
  $stmt->execute(array($id));
  $comments = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $comments[] = new Comment(
      $row['id'],
      $row['idItem'],
      $row['user'],
      $row['texto'],
    );
  }
  return $comments;
}

function add_comment(PDO $dbh, int $idItem, string $username, string $text) : void
{
  $stmt = $dbh->prepare('SELECT MAX(id) AS max_id FROM comment');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $id = $row['max_id'] ?? 0;
  $id = $id + 1;

  $stmt = $dbh->prepare('INSERT INTO comment VALUES(?, ?, ?, ?)');
  $stmt->execute(array($id, $idItem, $username, $text));
}

function is_sold(PDO $dbh, int $id) : bool 
{
  $stmt = $dbh->prepare('SELECT * FROM sold WHERE id = ?');
  $stmt->execute(array($id));
  return $stmt->fetch() !== false;
}

function buyer(PDO $dbh, int $id) : string 
{
  $stmt = $dbh->prepare('SELECT * FROM sold WHERE id = ?');
  $stmt->execute(array($id));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  return $row['buyer'];
}

function get_items_by_search(PDO $dbh, string $q): array
{
  $stmt = $dbh->prepare('SELECT * FROM item WHERE descriptionItem LIKE ?');
  $stmt->execute(array("$q%"));
  return $stmt->fetchAll();
}