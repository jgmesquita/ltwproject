<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/items.class.php');

  require_once(__DIR__ . '/../templates/basic.tpl.php');

  $db = get_database_connection();

  $items = Item::getItems($db, 10);

  drawHeader($session, 'Amazon LTW Shop');
  drawItems($items);
  drawFooter();
