<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/item.class.php');

  require_once(__DIR__ . '/../database/comment.class.php');

  require_once(__DIR__ . '/../templates/basic.tpl.php');

  require_once(__DIR__ . '/../templates/items.tpl.php');

  require_once(__DIR__ . '/../templates/user.tpl.php');

  $dbh = get_database_connection();

  $item = get_item($dbh, (int)$_GET['id']);

  $comments = get_comments($dbh, (int)$_GET['id']);

  drawHeader($session, "Item - " . $item->id, $dbh);
  drawItem($dbh, $item, $comments);
  drawFooter();