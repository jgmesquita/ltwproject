<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

register_user($dbh, $_POST['username'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['address_'], $_POST['city'], $_POST['country'], $_POST['postalCode'], $_POST['email'], $_POST['phone']);

header('Location: /pages/index.php');
