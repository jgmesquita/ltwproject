<?php

declare(strict_types=1);

require_once('../database/connection.db.php');

require_once('../database/comment.class.php');

require_once('../database/reply.class.php');
function register_user(PDO $dbh, string $username, string $password, string $firstName, string $lastName, string $address_, string $city, string $country, string $postalCode, string $email, string $phone): int
{
  if (!check_string($password)) {
    return 1;
  }
  $options = ['cost' => 12];
  if (!user_exist($dbh, $username)) {
    $stmt = $dbh->prepare('INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options), $firstName, $lastName, $address_, $city, $country, $postalCode, $email, $phone));
  }
  else {
    return 2;
  }
  return 0;
}

function check_string($str) : bool 
{
  $numMatches = preg_match_all('/\d/', $str, $matches);
  if (strlen($str) >= 8 && $numMatches >= 1) {
    return true;
  }
  return false;
}

function user_exist(PDO $dbh, string $username): bool 
{
  $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
  $stmt->execute(array($username));
  return $stmt->fetch() !== false;
}

function verify_user(PDO $dbh, string $username, string $password): bool
{
  $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
  $stmt->execute(array($username));
  if ($row = $stmt->fetch()) {
    return password_verify($password, $row['pw']);
  }
  else {
    return false;
  }
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
  $options = ['cost' => 12];
  $stmt = $dbh->prepare('UPDATE users SET pw = ? WHERE username = ?');
  $status = $stmt->execute(array(password_hash($new_password, PASSWORD_DEFAULT, $options), $username));
  return $status;
}

function is_admin(PDO $dbh, string $username): bool
{
  $stmt = $dbh->prepare('SELECT * FROM adminUser WHERE username = ?');
  $stmt->execute(array($username));
  return $stmt->fetch() !== false;
}

function add_admin(PDO $dbh, string $username): void
{
  $stmt = $dbh->prepare('INSERT INTO adminUser VALUES (?)');
  $stmt->execute(array($username));
}

function register_item(PDO $dbh, string $ownerUser, string $category, string $descriptionItem, string $sizeItem, string $color, int $price, string $brand, string $model, string $condtion, string $imagePath) : void 
{
  $stmt = $dbh->prepare('SELECT MAX(id) AS max_id FROM items');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $id = $row['max_id'] ?? 0;
  $id = $id + 1;

  $stmt = $dbh->prepare('INSERT INTO items VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
  $stmt->execute(array($id, $ownerUser, $category, $descriptionItem, $sizeItem, $color, $price, $brand, $model, $condtion, $imagePath));
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
      $row['category'],
      $row['descriptionItem'],
      $row['sizeItem'],
      $row['color'],
      $row['price'],
      $row['brand'],
      $row['model'],
      $row['condition'],
      $row['imagePath']
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
      $row['category'],
      $row['descriptionItem'],
      $row['sizeItem'],
      $row['color'],
      $row['price'],
      $row['brand'],
      $row['model'],
      $row['condition'],
      $row['imagePath']
    );
  }
  return $items;
}

function check_checkout_items(PDO $dbh, string $username) : array 
{
  $stmt = $dbh->prepare('SELECT items.* FROM items JOIN buy ON items.id = buy.id WHERE buy.user = ?');
  $stmt->execute(array($username));
  $items = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $items[] = new Item(
      $row['id'],
      $row['ownerUser'],
      $row['category'],
      $row['descriptionItem'],
      $row['sizeItem'],
      $row['category'],
      $row['price'],
      $row['brand'],
      $row['model'],
      $row['condition'],
      $row['imagePath']
    );
  }
  return $items;
}

function check_sold_items(PDO $dbh, string $username) : array 
{
  $stmt = $dbh->prepare('SELECT items.* FROM items JOIN sold ON items.id = sold.id WHERE sold.user = ?');
  $stmt->execute(array($username));
  $items = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $items[] = new Item(
      $row['id'],
      $row['ownerUser'],
      $row['category'],
      $row['descriptionItem'],
      $row['sizeItem'],
      $row['color'],
      $row['price'],
      $row['brand'],
      $row['model'],
      $row['condition'],
      $row['imagePath']
    );
  }
  return $items;
}

function add_sold(PDO $dbh, string $username) : void 
{
  $array = check_checkout_items($dbh, $username);
  foreach ($array as $item) {
    $stmt = $dbh->prepare('INSERT INTO sold VALUES (?, ?)');
    $stmt->execute(array($item->id, $username));
    remove_checkout($dbh, $username, $item->id);
    remove_wishlist($dbh, $username, $item->id);
  }
}

function calculate_checkout_metrics(array $items) : array
{
  $quantity = 0;
  $total = 0;
  foreach ($items as $item) {
    $total = $total + $item->price;
    $quantity = $quantity + 1;
  }
  $array['total'] = $total;
  $array['quantity'] = $quantity;
  return $array;
}

function add_checkout(PDO $dbh, string $username, int $id) : void 
{
  $stmt = $dbh->prepare('INSERT INTO buy VALUES (?, ?)');
  $stmt->execute(array($id, $username));
}

function remove_checkout(PDO $dbh, string $username, int $id) : void 
{
  $stmt = $dbh->prepare('DELETE FROM buy WHERE id = ? AND user = ?');
  $stmt->execute(array($id, $username));
}

function is_checkout_item(PDO $dbh, string $username, int $id) : bool
{
  $stmt = $dbh->prepare('SELECT * FROM buy WHERE id = ? AND user = ?');
  $stmt->execute(array($id, $username));
  return $stmt->fetch() !== false;
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
    $row['category'],
    $row['descriptionItem'],
    $row['sizeItem'],
    $row['color'],
    $row['price'],
    $row['brand'],
    $row['model'],
    $row['condition'],
    $row['imagePath']
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
  return $row['user'];
}

function get_items_by_search(PDO $dbh, string $q): array
{
  $stmt = $dbh->prepare('SELECT * FROM items WHERE descriptionItem LIKE ?');
  $stmt->execute(array("$q%"));
  return $stmt->fetchAll();
}

function remove_all_items_checkout(PDO $dbh, string $username) : void
{
  $items = check_checkout_items($dbh, $username);
  foreach ($items as $item) {
    remove_checkout($dbh, $username, $item->id);
  }
}

function get_all_sizes(PDO $dbh) : array 
{
  $stmt = $dbh->prepare('SELECT * FROM sizes');
  $stmt->execute();
  $sizes = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sizes[] = $row['sizeText'];
  }
  return $sizes;
}

function get_all_categories(PDO $dbh) : array 
{
  $stmt = $dbh->prepare('SELECT * FROM categories');
  $stmt->execute();
  $sizes = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sizes[] = $row['category'];
  }
  return $sizes;
}

function get_all_conditions(PDO $dbh) : array 
{
  $stmt = $dbh->prepare('SELECT * FROM conditions');
  $stmt->execute();
  $sizes = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sizes[] = $row['condition'];
  }
  return $sizes;
}

function add_condition(PDO $dbh, string $condition) : void 
{
  $stmt = $dbh->prepare('INSERT INTO conditions VALUES (?)');
  $stmt->execute(array($condition));
}

function add_size(PDO $dbh, string $size) : void 
{
  $stmt = $dbh->prepare('INSERT INTO sizes VALUES (?)');
  $stmt->execute(array($size));
}

function add_category(PDO $dbh, string $category) : void 
{
  $stmt = $dbh->prepare('INSERT INTO categories VALUES (?)');
  $stmt->execute(array($category));
}

function get_all_items(PDO $dbh) : array 
{
  $stmt = $dbh->prepare('SELECT * FROM items');
  $stmt->execute();
  $items = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $items[] = new Item(
      $row['id'],
      $row['ownerUser'],
      $row['category'],
      $row['descriptionItem'],
      $row['sizeItem'],
      $row['color'],
      $row['price'],
      $row['brand'],
      $row['model'],
      $row['condition'],
      $row['imagePath']
    );
  }
  return $items;
}

function get_items_by_category(PDO $dbh, String $category ):array
{
  $stmt = $dbh->prepare('SELECT * FROM items WHERE category=?');
  $stmt->execute(array($category));
  $items = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $items[] = new Item(
      $row['id'],
      $row['ownerUser'],
      $row['category'],
      $row['descriptionItem'],
      $row['sizeItem'],
      $row['color'],
      $row['price'],
      $row['brand'],
      $row['model'],
      $row['condition'],
      $row['imagePath']
    );
  }
  return $items;
}

function get_all_replies(PDO $dbh, int $idComment) : array
{
  $stmt = $dbh->prepare('SELECT * FROM reply WHERE idComment = ?');
  $stmt->execute(array($idComment));
  $replies = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $replies[] = new Reply(
      $row['idComment'],
      $row['user'],
      $row['texto'],
    );
  }
  return $replies;
}

function add_reply(PDO $dbh, int $idComment, string $username, string $text) : void 
{
  $stmt = $dbh->prepare('SELECT MAX(id) AS max_id FROM reply');
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $id = $row['max_id'] ?? 0;
  $id = $id + 1;

  $stmt = $dbh->prepare('INSERT INTO reply VALUES (?, ?, ?, ?)');
  $stmt->execute(array($id, $idComment, $username, $text));
}

function get_user(PDO $dbh, string $username) : User
{
  $stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute(array($username));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $user = new User(
    $row['username'],
    $row['firstName'],
    $row['lastName'],
    $row['address_'],
    $row['city'],
    $row['country'],
    $row['postalCode'],
    $row['email'],
    $row['phone']
  );
  return $user;
}

function generate_file(PDO $dbh, string $seller, string $buyer) : void 
{
  $file = fopen("temp.txt", "w");
  $user_seller = get_user($dbh, $seller);
  $user_buyer = get_user($dbh, $buyer);
  $txt = "Shipping Form\n";
  fwrite($file, $txt);
  $txt = "Shipper Information\n";
  fwrite($file, $txt);
  $txt = "Name: " . $user_seller->firstName . " " . $user_seller->lastName . "\n";
  $txt .= "Address: " . $user_seller->address . "\n";
  $txt .= "City: " . $user_seller->city . "\n";
  $txt .= "Country: " . $user_seller->country . "\n";
  $txt .= "Postal Code: " . $user_seller->postalcode . "\n";
  $txt .= "Phone: " . $user_seller->phone . "\n";
  fwrite($file, $txt);
  $txt = "Recipient Information";
  fwrite($file, $txt);
  $txt = "Name: " . $user_buyer->firstName . " " . $user_buyer->lastName . "\n";
  $txt .= "Address: " . $user_buyer->address . "\n";
  $txt .= "City: " . $user_buyer->city . "\n";
  $txt .= "Country: " . $user_buyer->country . "\n";
  $txt .= "Postal Code: " . $user_buyer->postalcode . "\n";
  $txt .= "Phone: " . $user_buyer->phone . "\n";
  fwrite($file, $txt);
  fclose($file);
}

function update_item(PDO $dbh, int $id, string $category, string $descriptionItem, string $size, string $color, int $price, string $brand, string $model, string $condition) : void 
{
  $stmt = $dbh->prepare('UPDATE items SET category = ?, descriptionItem = ?, sizeItem = ?, color = ?, price = ?, brand = ?, model = ?, condition = ? WHERE id = ?');
  $stmt->execute(array($category, $descriptionItem, $size, $color, $price, $brand, $model, $condition, $id));
}