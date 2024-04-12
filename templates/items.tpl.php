<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/user.db.php');
?>

<?php function drawItems(array $items) { ?>
    <section id="items">
        <?php foreach ($items as $item) { ?>
            <article>
                <h3><?=$item->descriptionItem ?></h3>
                <img src="https://picsum.photos/200?<?=$item->id?>"><br>
                <a href="../pages/index.php?">Link</a>
                <p id="model"><?=$item->model?></p>
                <p id="brand"><?=$item->brand?></p>
                <p id="price"><?=$item->price?></p>
            </article>
        <?php } ?>
    </section>
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