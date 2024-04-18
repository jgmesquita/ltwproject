<?php

declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

$dbh = get_database_connection();

register_item($dbh, $_SESSION['username'], $_POST['category'], $_POST['descriptionItem'], $_POST['sizeItem'], $_POST['color'], (int)$_POST['price'], $_POST['brand'], $_POST['model'], $_POST['condition'], '/images/' . $_FILES["image"]["name"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"])) {
        $uploadedFile = "../images/" . basename($_FILES["image"]["name"]); 
        move_uploaded_file($_FILES["image"]["tmp_name"], $uploadedFile);
    }
}

header('Location: /pages/index.php');
