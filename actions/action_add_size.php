<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

add_size($dbh, $_POST['size']);

header('Location: /pages/admin.php');