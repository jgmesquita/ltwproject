<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

register_item($dbh, $_SESSION['username'], $_POST['descriptionItem'], $_POST['sizeItem']);

header('Location: sucessfulRegister.php');
