<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

update_item($dbh, (int)$_POST['id'], $_POST['descriptionItem'], $_POST['sizeItem'], (int)$_POST['price'], $_POST['brand'], $_POST['model'], $_POST['condition']);

header('Location: /pages/listed_items.php');