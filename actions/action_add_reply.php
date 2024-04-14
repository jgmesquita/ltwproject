<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

add_reply($dbh, (int)$_GET['id'], $_SESSION['username'], $_GET['reply']);

header('Location: /pages/item.php?id=' . $_SESSION['id']);