<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

if (change_password($dbh, $_SESSION['username'], $_POST['password'])) {
    header('Location: /pages/index.php');
} else header('Location: /pages/where.php?error=5');