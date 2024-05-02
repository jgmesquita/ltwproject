<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/item.class.php');

  require_once(__DIR__ . '/../database/user.db.php');
?>

<?php function drawHeader(Session $session, string $title, PDO $dbh) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?=$title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/javascript/search.js" defer></script>
  </head>
  <body>
    <header>
      <h1><a href="/">Amazon LTW Shop</a></h1>
      <h2>Rediscover Treasures: Where Pre-Loved Finds New Love!</h2>
      <?php 
        if ($session->isLoggedIn()) drawLogoutForm($session);
        else drawLoginForm();
      ?>
    </header>

    <!--<div>
      <h4>Select by Category</h4>
      <ul>
        <?php
          /*$categories = get_all_categories($dbh);
          foreach($categories as $category){
            $parts = explode('-', $category);
            ?>
            <li>
            <a href="items_by_category.php?category=<?=($category) ?>">
              <?= $parts[1] ?>
              </a>
            </li>
          <?php } */?>    
      </ul>

    </div>-->

    <main>
<?php } ?>

<?php function drawHeaderNoLogin(Session $session, string $title) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?=$title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/javascript/search.js" defer></script>
  </head>
  <body>
    <header>
      <h1><a href="/">Amazon LTW Shop</a></h1>
      <h2>Rediscover Treasures: Where Pre-Loved Finds New Love!</h2>
    </header>
    <main>
<?php } ?>


<?php function drawFooter() { ?>
    </main>
    <footer>
      Amazon LTW Shop &copy; 2024
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLoginForm() { ?>
  <form action="/actions/action_login.php" method="post" class="login">
    <input type="username" name="username" placeholder="username" required>
    <input type="password" name="password" placeholder="password" required>
    <button type="submit">Login</button>
    <a href="/pages/register.php"> Register</a>
    <a href="/pages/search.php"> Search</a>
  </form>
<?php } ?>

<?php function drawRegisterForm() { ?>
  <form action="/actions/action_register.php" method="post" class="register">
    <input type="username" name="username" placeholder="username" required>
    <input type="password" name="password" placeholder="password" required>
    <input type="text" name="firstName" placeholder="firstName" required>
    <input type="text" name="lastName" placeholder="lastName" required>
    <input type="text" name="address_" placeholder="address_" required>
    <input type="text" name="city" placeholder="city" required>
    <input type="text" name="country" placeholder="country" required>
    <input type="text" name="postalCode" placeholder="postalCode" required>
    <input type="text" name="email" placeholder="email" required>
    <input type="text" name="phone" placeholder="phone" required>
    <button type="submit">Register</button>
  </form>
<?php } ?>

<?php function drawLogoutForm(Session $session) { ?>
  <form action="/actions/action_logout.php" method="post" class="logout">
    <a href="/pages/profile.php"><?=htmlentities($session->getId())?></a>
    <button type="submit">Logout</button>
    <a href="/pages/search.php">Search</a>
    <a href="/pages/register_item.php">Register Item</a>
    <a href="/pages/checkout.php">Checkout</a>
  </form>
<?php } ?>

<?php function drawChangeUsername() { ?>
  <form action="/actions/action_change_username.php" method="post" class="change_username">
    <input type=text name="username" placeholder="new username" required>
    <button type="submit">Change Username</button>
  </form>
  <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawChangeName() { ?>
  <form action="/actions/action_change_name.php" method="post" class="change_name">
    <input type=text name="firstName" placeholder="new firstName" required>
    <input type=text name="lastName" placeholder="new lastName" required>
    <button type="submit">Change Name</button>
  </form>
  <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawChangeEmail() { ?>
  <form action="/actions/action_change_email.php" method="post" class="change_name">
    <input type=text name="email" placeholder="new email" required>
    <button type="submit">Change Email</button>
  </form>
  <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawChangePassword() { ?>
  <form action="/actions/action_change_password.php" method="post" class="change_name">
    <input type=text name="password" placeholder="new password" required>
    <button type="submit">Change Password</button>
  </form>
  <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawOptionsProfile() { ?>
  <h3>Select which detail you wanna change!</h3>
  <a href="/pages/change_username.php">Change your username!</a>
  <a href="/pages/change_name.php">Change your name!</a>
  <a href="/pages/change_email.php">Change your email!</a>
  <a href="/pages/change_password.php">Change your password!</a>
  <a href="/pages/profile.php">Back</a>
<?php } ?>




<?php function drawItemsByCategory(PDO $dbh, string $category, string $title) { ?>
<!DOCTYPE html>
<html lang = "en-US">
    <head>
        <title><?=$title?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/style.css">
        <script src="/javascript/search.js" defer></script>
    </head>
    <body> 
        <h4>
            <?php
            $items = get_items_by_category($dbh, $category);
            drawItems($dbh, $items);
            ?>
        </h4>
    </body>

<?php } ?>

<?php function drawError(int $error) { ?>
  <?php switch ($error) { 
    case 1: ?> <p>The password must have at least 8 characters, one of which must be a number!</p> <?php break;
    case 2: ?> <p>The username is already being used! Try another one!</p> <?php break;
    case 3: ?> <p>You must be login to use this feature!</p> <?php break;
    case 4: ?> <p>You must be an admin to use this page!</p> <?php break; 
    case 5: ?> <p>There was an error! Please try again!</p> <?php break;
    case 6: ?> <p>The username/password is incorrect!</p> <?php break;
  } ?>
<?php } ?>