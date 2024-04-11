<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

if (change_email($dbh, $_SESSION['username'], $_POST['email'])) {
    header('Location: /pages/index.php');
} else header('Location: /pages/where.php');