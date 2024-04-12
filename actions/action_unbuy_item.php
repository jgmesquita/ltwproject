<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

remove_checkout($dbh, $_SESSION['username'], (int)$_SESSION['id']);

header('Location: /pages/item.php?id=' . $_SESSION['id']);