<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawProfile() { ?>
    <h3>Welcome, <?=$_SESSION['username']?>!</h3>
    <a href="/pages/edit_profile.php">Edit your profile!</a>
    <a href="/pages/listed_items.php">See the status of your listed items!</a>
    <a href="/pages/wishlist.php">See your wishlist!</a>
<?php } ?>