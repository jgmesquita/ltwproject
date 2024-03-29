<?php
  declare(strict_types=1);

  function get_database_connection() : PDO {
    $dbh = new PDO('sqlite:data/users.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbh;
  }

