<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

add_category($dbh, $_POST['category']);

header('Location: /pages/admin.php');