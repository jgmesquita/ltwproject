<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawItems(array $items) { ?>
    <section id="items">
        <?php foreach ($items as $item) { ?>
            <article>
                <h3><?=$item->descriptionItem ?></h3>
                <img src="https://picsum.photos/200?<?=$item->id?>">
                <a href="../pages/index.php">Link</a>
                <p id="model"><?=$item->model?></p>
                <p id="brand"><?=$item->brand?></p>
                <p id="price"><?=$item->price?></p>
            </article>
        <?php } ?>
    </section>
<?php } ?>