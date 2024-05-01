<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

$id = register_user($dbh, $_POST['username'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['address_'], $_POST['city'], $_POST['country'], $_POST['postalCode'], $_POST['email'], $_POST['phone']);

switch ($id) {
    case 0: header('Location: /pages/index.php'); break;
    case 1: header('Location: /pages/where.php?error=1'); break;
    case 2: header('Location: /pages/where.php?error=2'); break;
    default: header('Location: /pages/where.php?error=5'); break;
}

