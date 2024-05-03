<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawProfile() { ?>
  <section id="profile">
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
  </section>
<?php } ?>

<?php function drawAdminOptions() { ?>
  <section id="admin">
    <a href="/pages/elevate_admin.php">Elevate an user to admin</a>
    <a href="/pages/add_entities.php">Introduce new entities</a>
    <a href="/pages/all_items.php">Watch all items</a>
  </section>
<?php } ?>

<?php function drawElevateAdmin() { ?>
  <form action="/actions/action_elevate_admin.php" method="post" class="elevate_admin">
    <input type="text" name="username" placeholder="username">
    <button type="submit">Elevate user as admin</button>
  </form>
<?php } ?>

<?php function drawAddSize() { ?>
  <form action="/actions/action_add_size.php" method="post" class="add_size">
    <input type="text" name="size" placeholder="size">
    <button type="submit">Introduce new size</button>
  </form>
<?php } ?>

<?php function drawAddCategory() { ?>
  <form action="/actions/action_add_category.php" method="post" class="add_category">
    <input type="text" name="category" placeholder="category">
    <button type="submit">Introduce new category</button>
  </form>
<?php } ?>

<?php function drawAddCondition() { ?>
  <form action="/actions/action_add_condition.php" method="post" class="add_condition">
    <input type="text" name="condition" placeholder="condition">
    <button type="submit">Introduce new condition</button>
  </form>
<?php } ?>

