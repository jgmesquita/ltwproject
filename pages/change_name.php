<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/item.class.php');

  require_once(__DIR__ . '/../templates/basic.tpl.php');

  require_once(__DIR__ . '/../templates/items.tpl.php');

  require_once(__DIR__ . '/../templates/user.tpl.php');

  $dbh = get_database_connection();

  drawHeaderNoLogin($session, "Change Name");
  if (isset($_SESSION['username'])) {
    drawChangeName();
  }
  else {
    header('Location: /pages/where.php?error=3');
  }
  drawFooter();