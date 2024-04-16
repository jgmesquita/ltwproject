<?php
declare(strict_types=1);

session_start();

require_once('../database/user.db.php');

require_once(__DIR__ . '/../database/user.class.php');

$dbh = get_database_connection();

generate_file($dbh, $_POST['seller'], $_POST['buyer']);

$file = 'temp.txt';

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));

ob_clean();
flush();

readfile($file);

unlink($file);

exit;
?>
