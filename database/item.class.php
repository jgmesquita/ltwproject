<?php
  declare(strict_types = 1);

  class Item {
    public int $id;
    public string $ownerUser;
    public string $category;
    public string $descriptionItem;
    public string $sizeItem;
    public string $color;
    public int $price;
    public string $brand;
    public string $model;
    public string $condition;
    public string $imagePath;


    public function __construct(int $id, string $ownerUser, string $category, string $descriptionItem, string $sizeItem, string $color, int $price, string $brand, string $model, string $condition, string $imagePath)
    {
      $this->id = $id;
      $this->ownerUser = $ownerUser;
      $this->category = $category;
      $this->descriptionItem = $descriptionItem;
      $this->sizeItem = $sizeItem;
      $this->color = $color;
      $this->price = $price;
      $this->brand = $brand;
      $this->model = $model;
      $this->condition = $condition;
      $this->imagePath = $imagePath;
    }

    public static function getItems(PDO $db, int $count): array {
        $query = "SELECT * FROM items ORDER BY id DESC LIMIT 10";
        $statement = $db->prepare($query);
        $statement->execute();

        $items = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $items[] = new Item(
                $row['id'],
                $row['ownerUser'],
                $row['category'],
                $row['descriptionItem'],
                $row['sizeItem'],
                $row['color'],
                $row['price'],
                $row['brand'],
                $row['model'],
                $row['condition'],
                $row['imagePath']
            );
        }
        return $items;
    }
  }