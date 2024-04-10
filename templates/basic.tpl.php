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
    <a href="/pages/register.php">Register</a>
    <button type="submit">Login</button>
  </form>
<?php } ?>

<?php function drawRegisterForm() { ?>
  <form action="/actions/action_register.php" method="post" class="login">
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
  </form>
<?php } ?>