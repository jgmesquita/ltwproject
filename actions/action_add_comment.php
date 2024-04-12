<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

add_comment($dbh, $_SESSION['id'], $_SESSION['username'], $_POST['comment']);

header('Location: /pages/item.php?id=' . $_SESSION['id']);