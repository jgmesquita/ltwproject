<?php
  declare(strict_types = 1);

  class User {
    public string $id;
    public string $firstName;
    public string $lastName;
    public string $address;
    public string $city;
    public string $country;
    public string $postalcode;
    public string $email;
    public string $phone;

    public function __construct(string $id, string $firstName, string $lastName, string $address, string $city, string $country, string $postalcode, string $email, string $phone)
    {
      $this->id = $id;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->address = $address;
      $this->city = $city;
      $this->country = $country;
      $this->postalcode = $postalcode;
      $this->email = $email;
      $this->phone = $phone;
    }

    function name() {
      return $this->firstName . ' ' . $this->lastName;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE Customer SET FirstName = ?, LastName = ?
        WHERE CustomerId = ?
      ');

      $stmt->execute(array($this->firstName, $this->lastName, $this->id));
    }
    
    static function getUser(PDO $db, string $username, string $password) : ?User {
      $stmt = $db->prepare('
        SELECT username, pw, firstName, lastName, address_, city, country, postalCode, email, phone
        FROM users
        WHERE lower(email) = ? AND password = ?
      ');

      $stmt->execute(array(strtolower($username), sha1($password)));
  
      if ($customer = $stmt->fetch()) {
        return new User(
          $customer['username'],
          $customer['firstName'],
          $customer['lastName'],
          $customer['address_'],
          $customer['city'],
          $customer['country'],
          $customer['postalCode'],
          $customer['email'],
          $customer['phone'],
        );
      } else return null;
    }
  }
