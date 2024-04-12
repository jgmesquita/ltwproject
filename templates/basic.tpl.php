<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader(Session $session, string $title) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?=$title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
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
    <input type="username" name="username" placeholder="username">
    <input type="password" name="password" placeholder="password">
    <button type="submit">Login</button>
    <a href="/pages/register.php"> Register</a>
    <a href="/pages/register.php"> Search</a>
  </form>
<?php } ?>

<?php function drawRegisterForm() { ?>
  <form action="/actions/action_register.php" method="post" class="register">
    <input type="username" name="username" placeholder="username">
    <input type="password" name="password" placeholder="password">
    <input type="text" name="firstName" placeholder="firstName">
    <input type="text" name="lastName" placeholder="lastName">
    <input type="text" name="address_" placeholder="address_">
    <input type="text" name="city" placeholder="city">
    <input type="text" name="country" placeholder="country">
    <input type="text" name="postalCode" placeholder="postalCode">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="phone" placeholder="phone">
    <button type="submit">Register</button>
  </form>
<?php } ?>

<?php function drawLogoutForm(Session $session) { ?>
  <form action="/actions/action_logout.php" method="post" class="logout">
    <a href="/pages/profile.php"><?=$session->getId()?></a>
    <button type="submit">Logout</button>
    <a href="/pages/search.php">Search</a>
    <a href="/pages/register_item.php">Register Item</a>
  </form>
<?php } ?>

<?php function drawChangeUsername() { ?>
  <form action="/actions/action_change_username.php" method="post" class="change_username">
    <input type=text name="username" placeholder="new username">
    <button type="submit">Change Username</button>
  </form>
  <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawChangeName() { ?>
  <form action="/actions/action_change_name.php" method="post" class="change_name">
    <input type=text name="firstName" placeholder="new firstName">
    <input type=text name="lastName" placeholder="new lastName">
    <button type="submit">Change Name</button>
  </form>
  <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawChangeEmail() { ?>
  <form action="/actions/action_change_email.php" method="post" class="change_name">
    <input type=text name="email" placeholder="new email">
    <button type="submit">Change Email</button>
  </form>
  <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawChangePassword() { ?>
  <form action="/actions/action_change_password.php" method="post" class="change_name">
    <input type=text name="password" placeholder="new password">
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