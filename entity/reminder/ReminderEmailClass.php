<?php

require_once 'entity/EntityClass.php';

class ReminderEmailClass extends EntityClass {
  protected $remind_email_id;
  protected $reminder_id;
  protected $email;
  
  public function __construct($properties = null) {
    parent::__construct($properties);
  }
  public function getRemindEmailID() {
    return $this->remind_email_id;
  }

  public function getReminderID() {
    return $this->reminder_id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setRemindEmailID($remindEmailID) {
    $this->remind_email_id = $remindEmailID;
  }

  public function setReminderID($reminderID) {
    $this->reminder_id = $reminderID;
  }

  public function setEmail($email) {
    $this->email = $email;
  }
}
