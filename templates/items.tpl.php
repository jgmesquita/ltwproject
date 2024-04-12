<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/user.db.php');

  require_once(__DIR__ . '/../database/item.class.php');
?>

<?php function drawItems(PDO $dbh, array $items) { ?>
    <section id="items">
        <?php foreach ($items as $item) { ?>
            <?php if (!is_sold($dbh, $item->id)) { ?>
            <article>
                <h3><?=$item->descriptionItem ?></h3>
                <img src="https://picsum.photos/200?<?=$item->id?>"><br>
                <a href="/pages/item.php?id=<?=$item->id?>">Link</a>
                <p id="model"><?=$item->model?></p>
                <p id="brand"><?=$item->brand?></p>
                <p id="price"><?=$item->price?></p>
            </article>
            <?php } ?>
        <?php } ?>
    </section>
<?php } ?>

<?php function drawItem(PDO $dbh, Item $item, array $comments) { ?>
    <section id="item">
        <h3><?=$item->descriptionItem ?></h3>
        <img src="https://picsum.photos/200?<?=$item->id?>"><br>
        <p id="model"><?=$item->model?></p>
        <p id="brand"><?=$item->brand?></p>
        <p id="price"><?=$item->price?></p>
    </section>
    <?php $_SESSION['id'] = $item->id; ?>
    <?php if (isset($_SESSION['username'])) { ?>
    <form action="/actions/action_add_comment.php" method="post" class="comment">
        <input type="text" name="comment" placeholder="comment">
        <button type="submit">Write Comment</button>
    </form>
    <?php if (!is_wishlist_item($dbh, $_SESSION['username'], $item->id)) { ?>
    <form action="/actions/action_add_wishlist.php" method="post" class="wishlist">
        <button type="submit">Add to Wishlist</button>
    </form>
    <?php } else { ?>
        <form action="/actions/action_remove_wishlist.php" method="post" class="wishlist">
        <button type="submit">Remove from Wishlist</button>
    </form>
    <?php } ?>
    <form action="/actions/action_buy_item.php" method="post" class="buy">
        <button type="submit">Add to Cart</button>
    <?php } ?>
    <section id="comments">
        <?php foreach ($comments as $comment) { ?>
            <section id="comment">
                <p id="userComment"><?=$comment->user?> commented:</p>
                <p id="textComment"><?=$comment->text?></p>
                <a href="/pages/reply.php">Reply</a>
            </section>
        <?php } ?>
    </section>
<?php } ?>


<?php function drawListItems(PDO $dbh, array $items) { ?>
    <section id="items">
        <table>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Size</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Condition</th>
                <th>Status</th>
            </tr>
        <?php foreach ($items as $item) { ?>
            <tr>
                <th><?=$item->id?></th>
                <th><?=$item->descriptionItem?></th>
                <th><?=$item->sizeItem?></th>
                <th><?=$item->price?></th>
                <th><?=$item->brand?></th>
                <th><?=$item->model?></th>
                <th><?=$item->condition?></th>
                <th><?php if (is_sold($dbh, $item->id)) {
                    echo "Bought by " . buyer($dbh, $item->id); 
                }
                else {
                    echo "Listed";
                }?></th>
            </tr>            
        <?php } ?>
        </table>
    </section>
    <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawRegisterItemForm() { ?>
    <form action="/actions/action_register_item.php" method="post" class="register_item">
        <input type="text" name="descriptionItem" placeholder="description">
        <input type="radio" id="S" name="sizeItem" value="S">
        <label for="S">S</label>
        <input type="radio" id="M" name="sizeItem" value="M">
        <label for="M">M</label>
        <input type="radio" id="L" name="sizeItem" value="L">
        <label for="L">L</label>
        <input type="number" name="price" placeholder="price">
        <input type="text" name="brand" placeholder="brand">
        <input type="text" name="model" placeholder="model">
        <input type="text" name="condition" placeholder="condition">
        <button type="submit">Register Item</button>
    </form>
<?php } ?>

<?php function drawSearchArea() { ?>
  <section id="search">
    <label>Description:
      <input type="text">
    </label>
    <table>
      <thead>
        <tr>
            <th>ID</th>
            <th>Owner</th>
            <th>Description</th>
            <th>Size</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Condition</th>
            <th>Status</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </section>
<?php } ?>