<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/user.db.php');

  require_once(__DIR__ . '/../database/item.class.php');

  require_once(__DIR__ . '/../database/reply.class.php');
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
    <?php if (!is_checkout_item($dbh, $_SESSION['username'], $item->id)) { ?>
    <form action="/actions/action_buy_item.php" method="post" class="buy">
        <button type="submit">Add to Cart</button>
    </form>
    <?php } else { ?>
        <form action="/actions/action_unbuy_item.php" method="post" class="buy">
        <button type="submit">Remove from Cart</button>
    </form>
    <?php } ?>
    <?php } ?>
    <section id="comments">
        <?php foreach ($comments as $comment) { ?>
            <section id="comment">
                <p id="userComment"><?=$comment->user?> commented:</p>
                <p id="textComment"><?=$comment->text?></p>
                <?php $replies = get_all_replies($dbh, $comment->id);
                foreach ($replies as $reply) { ?>
                    <section id="reply">
                    <p id="userReply"><?=$reply->user?> replied:</p>
                    <p id="textReply"><?=$reply->text?></p>
                    </section>
                <?php } ?>
                <form action="/actions/action_add_reply.php" method="post" class="reply">
                    <input type="hidden" name="id" value = <?=$comment->id?>>
                    <input type="text" name="reply" placeholder="reply">
                    <button type="submit">Reply</button>
                </form>
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

<?php function drawListedItems(PDO $dbh, array $items) { ?>
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
                <th>Shipping Form</th>
            </tr>
        <?php foreach ($items as $item) { ?>
            <tr>
                <th><a href="/pages/item.php?id=<?=$item->id?>"><?=$item->id?></a></th>
                <th><?=$item->descriptionItem?></th>
                <th><?=$item->sizeItem?></th>
                <th><?=$item->price?></th>
                <th><?=$item->brand?></th>
                <th><?=$item->model?></th>
                <th><?=$item->condition?></th>
                <th><?php if (is_sold($dbh, $item->id)) {
                    echo "Bought by " . buyer($dbh, $item->id) . "</th>";?>
                    <?="<th>"?>
                    <form action="/actions/action_generate_file.php" method="post" class="generate">
                        <input type="hidden" name="seller" value="<?=$_SESSION['username']?>">
                        <input type="hidden" name="buyer" value="<?=buyer($dbh, $item->id)?>">
                        <button type="submit">Generate</button>
                    </form>
                    <?="</th>"?>
                <?php } 
                else {
                    echo "Listed" . "</th>";
                    echo "<th></th>";
                }?>
            </tr>            
        <?php } ?>
        </table>
    </section>
    <a href="/pages/profile.php">Back</a>
<?php } ?>

<?php function drawRegisterItemForm(PDO $dbh) { ?>
    <form action="/actions/action_register_item.php" method="post" class="register_item">
        <label for="descriptionItem">Choose a category:</label>
        <select name="descriptionItem" id="description">
            <?php $categories = get_all_categories($dbh);
            foreach ($categories as $category) { ?>
                <option value="<?=$category?>"><?=$category?></option>
            <?php } ?> 
        </select>
        <label for="sizeItem">Choose a size:</label>
        <select name="sizeItem" id="sizeItem">
            <?php $sizes = get_all_sizes($dbh);
            foreach ($sizes as $size) { ?>
                <option value="<?=$size?>"><?=$size?></option>
            <?php } ?> 
        </select>
        <label for="price">Price:</label>
        <input type="number" name="price" placeholder="price">
        <label for="cars">Brand:</label>
        <input type="text" name="brand" placeholder="brand">
        <label for="cars">Model:</label>
        <input type="text" name="model" placeholder="model">
        <label for="cars">Choose a condition:</label>
        <select name="condition" id="condition">
            <?php $conditions = get_all_conditions($dbh);
            foreach ($conditions as $condition) { ?>
                <option value="<?=$condition?>"><?=$condition?></option>
            <?php } ?> 
        </select>
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

<?php function drawCheckout(PDO $dbh, int $total, int $quantity) { ?>
    <p>Your order has a total of <?= $total?> items and the cost is <?=$quantity?>!</p>
    <form action="/actions/action_checkout.php" method="post" class="checkout">
        <button type="submit">Checkout</button>
    </form>
    <form action="/actions/action_remove_all_items_checkout.php" method="post" class="remove_checkout">
        <button type="submit">Remove All Items</button>
    </form>
<?php } ?>