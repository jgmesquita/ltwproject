<?php
  declare(strict_types = 1);
    class Comment {
        public int $id;
        public int $idItem;
        public string $user;
        public string $text;
        public function __construct(int $id, int $idItem, string $user, string $text) {
            $this->id = $id;
            $this->idItem = $idItem;
            $this->user = $user;
            $this->text = $text;
        }
    }
