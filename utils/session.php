<?php
  class Session {

    public function __construct() {
      session_start();
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['username']);    
    }

    public function logout() {
      session_destroy();
    }

    public function getId() : ?int {
      return isset($_SESSION['username']) ? $_SESSION['username'] : null;    
    }

    public function getName() : ?string {
      return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function setId(int $id) {
      $_SESSION['username'] = $id;
    }

    public function setName(string $name) {
      $_SESSION['name'] = $name;
    }
  }