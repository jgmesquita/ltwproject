<?php
  declare(strict_types = 1);
    class Reply {
        public int $idComment;
        public string $user;
        public string $text;
        public function __construct(int $idComment, string $user, string $text) {
            $this->idComment = $idComment;
            $this->user = $user;
            $this->text = $text;
        }
    }