<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

register_item($dbh, $_SESSION['username'], $_POST['category'], $_POST['descriptionItem'], $_POST['sizeItem'], $_POST['color'], (int)$_POST['price'], $_POST['brand'], $_POST['model'], $_POST['condition'], $_POST['imagePath']);

header('Location: /pages/index.php');
