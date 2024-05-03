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
      <h1><a href="/">ReTreasure</a></h1>
      <h2>Rediscover Treasures: Where Pre-Loved Finds New Love!</h2>
      <?php 
        if ($session->isLoggedIn()) drawLogoutForm($session);
        else drawLoginForm();
      ?>
    </header>
    <aside>At ReTreasure, we believe that every item has a story and a journey, and it shouldn't end just because it's no longer brand new. Our platform is the premier online destination for buying and selling high-quality, pre-loved items, ranging from fashion and furniture to electronics and toys. Come checkout our amazings sellers! You can join us in our mission to create a better world!
    </aside>
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
      <h1><a href="/">ReTreasure</a></h1>
      <h2>Rediscover Treasures: Where Pre-Loved Finds New Love!</h2>
    </header>
    <aside>At ReTreasure, we believe that every item has a story and a journey, and it shouldn't end just because it's no longer brand new. Our platform is the premier online destination for buying and selling high-quality, pre-loved items, ranging from fashion and furniture to electronics and toys. Come checkout our amazings sellers! You can join us in our mission to create a better world!
    </aside>
    <main>
<?php } ?>


<?php function drawFooter() { ?>
    </main>
    <footer>
      ReTreasure &copy; 2024
    </footer>
  </body>
</html>
<?php } ?>

<?php function drawLoginForm() { ?>
  <form action="/actions/action_login.php" method="post" class="login">
    <section>
      <input type="username" name="username" placeholder="username" required>
      <input type="password" name="password" placeholder="password" required>
      <button type="submit">Login</button>
    </section>
    <section>
      <a href="/pages/register.php"> Register</a>
      <a href="/pages/search.php"> Search</a>
    </section>
  </form>
<?php } ?>

<?php function drawRegisterForm() { ?>
  <section id="register">
  <h2>Register</h2>
  <h3>Fill out the following form to participate in our shop!</h3>
  </section>
  <form action="/actions/action_register.php" method="post" class="register">
    <h4>Username:</h4>
    <input type="username" name="username" placeholder="username" required>
    <h4>Password:</h4>
    <input type="password" name="password" placeholder="password" required>
    <h4>First Name:</h4>
    <input type="text" name="firstName" placeholder="firstName" required>
    <h4>Last Name:</h4>
    <input type="text" name="lastName" placeholder="lastName" required>
    <h4>Address:</h4>
    <input type="text" name="address_" placeholder="address_" required>
    <h4>City:</h4>
    <input type="text" name="city" placeholder="city" required>
    <h4>Country:</h4>
    <input type="text" name="country" placeholder="country" required>
    <h4>Postal-Code:</h4>
    <input type="text" name="postalCode" placeholder="postalCode" required>
    <h4>E-mail:</h4>
    <input type="text" name="email" placeholder="email" required>
    <h4>Phone:</h4>
    <input type="text" name="phone" placeholder="phone" required>
    <button type="submit">Register</button>
  </form>
<?php } ?>

<?php function drawLogoutForm(Session $session) { ?>
  <form action="/actions/action_logout.php" method="post" class="logout">
    <article id="hamburger">
      <label class="burger" for="burger">&#8801;</label>
      <input type="checkbox" id="burger">
        <section id="links">
          <a href="/pages/profile.php"><?="Welcome, " . htmlentities($session->getId()) . "!"?></a>
          <a href="/pages/search.php">Search</a>
          <a href="/pages/register_item.php">Register Item</a>
          <a href="/pages/checkout.php">Checkout</a>
          <button type="submit">Logout</button>
        </section>
    </article>
  </form>
<?php } ?>

<?php function drawChangeUsername() { ?>
  <section id="change">
    <form action="/actions/action_change_username.php" method="post" class="change_username">
      <h4>Write the new username!</h4>
      <input type=text name="username" placeholder="new username" required>
      <button type="submit">Change Username</button>
    </form>
    <a href="/pages/profile.php">Back</a>
  </section>
<?php } ?>

<?php function drawChangeName() { ?>
  <section id="change">
    <form action="/actions/action_change_name.php" method="post" class="change_name">
      <h4>Write the new name!</h4>
      <input type=text name="firstName" placeholder="new firstName" required>
      <input type=text name="lastName" placeholder="new lastName" required>
      <button type="submit">Change Name</button>
    </form>
    <a href="/pages/profile.php">Back</a>
  </section>
<?php } ?>

<?php function drawChangeEmail() { ?>
  <section id="change">
    <form action="/actions/action_change_email.php" method="post" class="change_name">
      <h4>Write the new email!</h4>
      <input type=text name="email" placeholder="new email" required>
      <button type="submit">Change Email</button>
    </form>
    <a href="/pages/profile.php">Back</a>
  </section>
<?php } ?>

<?php function drawChangePassword() { ?>
  <section id="change">
    <form action="/actions/action_change_password.php" method="post" class="change_name">
      <h4>Write the new password!</h4>
      <input type=text name="password" placeholder="new password" required>
      <button type="submit">Change Password</button>
    </form>
    <a href="/pages/profile.php">Back</a>
  </section>
<?php } ?>

<?php function drawOptionsProfile() { ?>
  <section id="options">
    <h3>Select which detail you wanna change!</h3>
    <a href="/pages/change_username.php">Change your username!</a>
    <a href="/pages/change_name.php">Change your name!</a>
    <a href="/pages/change_email.php">Change your email!</a>
    <a href="/pages/change_password.php">Change your password!</a>
    <a href="/pages/profile.php">Back</a>
  </section>
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