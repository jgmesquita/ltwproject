<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

add_admin($dbh, $_POST['username']);

header('Location: /pages/admin.php');