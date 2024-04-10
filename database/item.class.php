<?php
  declare(strict_types = 1);

  class Item {
    public int $id;
    public string $ownerUser;
    public string $descriptionItem;
    public string $sizeItem;
    public int $price;
    public string $brand;
    public string $model;
    public string $condition;


    public function __construct(int $id, string $ownerUser, string $descriptionItem, string $sizeItem, int $price, string $brand, string $model, string $condition)
    {
      $this->id = $id;
      $this->ownerUser = $ownerUser;
      $this->descriptionItem = $descriptionItem;
      $this->sizeItem = $sizeItem;
      $this->price = $price;
      $this->brand = $brand;
      $this->model = $model;
      $this->condition = $condition;
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
                $row['descriptionItem'],
                $row['sizeItem'],
                $row['price'],
                $row['brand'],
                $row['model'],
                $row['condition']
            );
        }
        return $items;
    }
  }