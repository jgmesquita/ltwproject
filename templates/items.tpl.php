<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/user.db.php');

  require_once(__DIR__ . '/../database/item.class.php');

  require_once(__DIR__ . '/../database/reply.class.php');
?>

<?php function drawItems(PDO $dbh, array $items) { ?>
    <section id="items">
        <h3>Our latest items!</h3>
        <?php foreach ($items as $item) { ?>
            <?php if (!is_sold($dbh, $item->id)) { ?>
            <article>
                <h3><?=$item->category?></h3>
                <img src="<?=$item->imagePath?>"><br>
                <section id="description">
                    <a href="/pages/item.php?id=<?=$item->id?>">Link</a>
                    <p id="descriptionItem">Description: <?=htmlspecialchars($item->descriptionItem)?></p>
                    <p id="model">Model: <?=htmlspecialchars($item->model)?></p>
                    <p id="brand">Brand: <?=htmlspecialchars($item->brand)?></p>
                    <p id="price">Price: <?=$item->price?>&#8364</p>
                </section>
            </article>
            <?php } ?>
        <?php } ?>
    </section>
<?php } ?>

<?php function drawItem(PDO $dbh, Item $item, array $comments) { ?>
    <section id="item">
        <h3><?=$item->category?></h3>
        <img src=<?=$item->imagePath?>>
        <section id="specific">
            <p id="seller">Seller: <?=htmlspecialchars($item->ownerUser)?></p>
            <p id="model">Model: <?=htmlspecialchars($item->model)?></p>
            <p id="brand">Brand: <?=htmlspecialchars($item->brand)?></p>
            <p id="price">Price: <?=$item->price?></p>
            <p id="descriptionItem">Description: <?=htmlspecialchars($item->descriptionItem)?></p>
        </section>
    </section>
    <?php $_SESSION['id'] = $item->id; ?>
    <?php if (isset($_SESSION['username'])) { ?>
    <section id="addcomment">
        <h3>Do you have any questions? Try to comment!</h3>
        <form action="/actions/action_add_comment.php" method="post" class="comment">
            <input type="text" name="comment" placeholder="comment">
            <button type="submit">Write Comment</button>
        </form>
    </section>
    <section id="wb">
        <h3>Interact with the item!</h3>
    <?php if (!is_wishlist_item($dbh, $_SESSION['username'], $item->id)) { ?>
    <form action="/actions/action_add_wishlist.php" method="post" class="wishlist">
            <button type="submit">Add to Wishlist</button>
        </section>
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
    </section>
    <?php } ?>
    <?php } ?>
    <section id="comments">
        <?php foreach ($comments as $comment) { ?>
            <section id="comment">
                <p id="userComment"><?=htmlspecialchars($comment->user)?> commented:</p>
                <p id="textComment"><?=htmlspecialchars($comment->text)?></p>
                <?php $replies = get_all_replies($dbh, $comment->id);
                foreach ($replies as $reply) { ?>
                    <section id="reply">
                    <p id="userReply"><?=htmlspecialchars($reply->user)?> replied:</p>
                    <p id="textReply"><?=htmlspecialchars($reply->text)?></p>
                    </section>
                <?php } ?>
                <?php if (isset($_SESSION['username'])) { ?>
                <form action="/actions/action_add_reply.php" method="post" class="reply">
                    <input type="hidden" name="id" value = <?=$comment->id?>>
                    <input type="text" name="reply" placeholder="reply">
                    <button type="submit">Reply</button>
                </form>
                <?php } ?>
            </section>
        <?php } ?>
    </section>
<?php } ?>


<?php function drawListItems(PDO $dbh, array $items) { ?>
    <section id="items">
        <h3>There is the list you requested!</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th>Size</th>
                <th>Color</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Condition</th>
                <th>Status</th>
            </tr>
        <?php foreach ($items as $item) { ?>
            <tr>
                <th><?=$item->id?></th>
                <th><?=$item->category?></th>
                <th><?=$item->descriptionItem?></th>
                <th><?=$item->sizeItem?></th>
                <th><?=$item->color?></th>
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
        <a href="/pages/profile.php">Back</a>
    </section>
<?php } ?>

<?php function drawListedItems(PDO $dbh, array $items) { ?>
    <section id="items">
        <h3>There is the list you requested!</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
                <th>Size</th>
                <th>Color</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Condition</th>
                <th>Status</th>
                <th>Shipping Form</th>
                <th>Update</th>
            </tr>
        <?php foreach ($items as $item) { ?>
            <tr>
                <th><a href="/pages/item.php?id=<?=$item->id?>"><?=$item->id?></a></th>
                <th><?=$item->category?></th>
                <th><?=$item->descriptionItem?></th>
                <th><?=$item->sizeItem?></th>
                <th><?=$item->color?></th>
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
                <th><a href="/pages/update_item.php?id=<?=$item->id?>">Update</a></th>
            </tr>            
        <?php } ?>
        </table>
        <a href="/pages/profile.php">Back</a>
    </section>
<?php } ?>

<?php function drawRegisterItemForm(PDO $dbh) { ?>
    <form action="/actions/action_register_item.php" method="post" class="register_item" enctype="multipart/form-data">
        <h4>Write a description:</h4>
        <input type="text" name="descriptionItem" placeholder="description" required>
        <h4>Choose a category:</h4>
        <select name="category" id="category">
            <?php $categories = get_all_categories($dbh);
            foreach ($categories as $category) { ?>
                <option value="<?=$category?>"><?=$category?></option>
            <?php } ?> 
        </select>
        <h4>Color:</h4>
        <input type="text" name="color" placeholder="color" required>
        <h4>Choose a size:</h4>
        <select name="sizeItem" id="sizeItem">
            <?php $sizes = get_all_sizes($dbh);
            foreach ($sizes as $size) { ?>
                <option value="<?=$size?>"><?=$size?></option>
            <?php } ?> 
        </select>
        <h4>Price:</h4>
        <input type="number" name="price" placeholder="price" required>
        <h4>Brand:</h4>
        <input type="text" name="brand" placeholder="brand" required>
        <h4>Model:</h4>
        <input type="text" name="model" placeholder="model" required>
        <h4>Choose a condition:</h4>
        <select name="condition" id="condition">
            <?php $conditions = get_all_conditions($dbh);
            foreach ($conditions as $condition) { ?>
                <option value="<?=$condition?>"><?=$condition?></option>
            <?php } ?> 
        </select>
        <h4>Upload a picture:</h4>
        <input type="file" name="image" placeholder="file" required>
        <button type="submit">Register Item</button>
    </form>
<?php } ?>

<?php function drawUpdateItemForm(PDO $dbh, int $id) { ?>
    <form action="/actions/action_update_item.php" method="post" class="update_item">
        <input type="hidden" name="id" value = <?=$id?>>
        <h4>Write a description:</h4>
        <input type="text" name="descriptionItem" placeholder="description" required>
        <h4>Choose a category:</h4>
        <select name="category" id="category">
            <?php $categories = get_all_categories($dbh);
            foreach ($categories as $category) { ?>
                <option value="<?=$category?>"><?=$category?></option>
            <?php } ?> 
        </select>
        <h4>Color:</h4>
        <input type="text" name="color" placeholder="color" required>
        <h4>Choose a size:</h4>
        <select name="sizeItem" id="sizeItem">
            <?php $sizes = get_all_sizes($dbh);
            foreach ($sizes as $size) { ?>
                <option value="<?=$size?>"><?=$size?></option>
            <?php } ?> 
        </select>
        <h4>Price:</h4>
        <input type="number" name="price" placeholder="price" required>
        <h4>Brand:</h4>
        <input type="text" name="brand" placeholder="brand" required>
        <h4>Model:</h4>
        <input type="text" name="model" placeholder="model" required>
        <h4>Choose a condition:</h4>
        <select name="condition" id="condition">
            <?php $conditions = get_all_conditions($dbh);
            foreach ($conditions as $condition) { ?>
                <option value="<?=$condition?>"><?=$condition?></option>
            <?php } ?> 
        </select>
        <button type="submit">Update Item</button>
    </form>
<?php } ?>

<?php function drawSearchArea() { ?>
  <section id="search">
    <label>Search an item by writting its description:</label>
    <input type="text">
    <table>
      <thead>
        <tr>
            <th>ID</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Description</th>
            <th>Size</th>
            <th>Color</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Condition</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </section>
<?php } ?>

<?php function drawCheckout(PDO $dbh, int $total, int $quantity) { ?>
    <section id="details">Your order has a total of <?= $total?> items and the cost is <?=$quantity?>&#8364!</section>
    <input type="hidden" name="cost" value = <?=$quantity?>>
    <section id="currency_conversion">
        <label>Change currency:</label>
        <select name="currency" id="currency" onchange="displayCurrency()">
            <option value="USD">USD</option>
            <option value="JPY">JPY</option>
            <option value="RMB">RMB</option>
            <option value="KRW">KRW</option>
            <option value="GBP">GBP</option>
        </select>
    <div id="output">Selected Currency: None</div>
    </section>
    <section id="actions">
    <form action="/actions/action_checkout.php" method="post" class="checkout">
        <button type="submit" id="checkout">Checkout</button>
    </form>
    <form action="/actions/action_remove_all_items_checkout.php" method="post" class="remove_checkout">
        <button type="submit">Remove All Items</button>
    </form>
    </section>
<?php } ?>