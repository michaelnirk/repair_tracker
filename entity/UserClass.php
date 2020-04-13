<?php

require_once 'entity/EntityClass.php';

class UserClass extends EntityClass {
  protected $user_id;
  protected $first_name;
  protected $last_name;
  protected $email;
  protected $create_datetime;
  
  public function __construct($properties = null) {
    parent::__construct($properties);
  }
  public function getUserID() {
    return $this->user_id;
  }

  public function getFirstName() {
    return $this->first_name;
  }

  public function getLastName() {
    return $this->last_name;
  }

  public function getEmail() {
    return $this->email;
  }
  public function getCreateDatetime() {
    return $this->create_datetime;
  }
  
  public function setUserID($userID) {
    $this->user_id = $userID;
  }

  public function setFirstName($firstName) {
    $this->first_name = $firstName;
  }

  public function setLastName($lastName) {
    $this->last_name = $lastName;
  }

  public function setEmail($email) {
    $this->email = $email;
  }
  public function setCreateDatetime($createDatetime) {
    $this->create_datetime = $createDatetime;
  }
}
