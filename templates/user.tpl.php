<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawProfile() { ?>
    <h3>Welcome, <?=$_SESSION['username']?>!</h3>
    <span id="definition">
      <h4>Definitions</h4>
      <a href="/pages/edit_profile.php">Edit your profile</a>
    </span>
    <span id="seller">
      <h4>As a seller</h4>
      <a href="/pages/listed_items.php">Status of your listed items</a>
    </span>
    <span id="buyer">
      <h4>As a buyer</h4>
      <a href="/pages/wishlist.php">Wishlist</a>
      <a href="/pages/order.php">Orders</a>
    </span>
    <span id="admin">
      <h4>As an admin</h4>
      <a href="/pages/admin.php">Management</a>
    </span>
<?php } ?>