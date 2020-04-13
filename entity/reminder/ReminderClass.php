<?php

require_once 'entity/EntityClass.php';

class ReminderClass extends EntityClass {
  protected $reminder_id;
  protected $user_id;
  protected $reminder_text;
  protected $deleted;
  protected $create_datetime;
  protected $reminder_datetimes;
  protected $reminder_emails;

  public function __construct($properties = null) {
    parent::__construct($properties);
  }
  
  public function getReminderID() {
    return $this->reminder_id;
  }

  public function getUserID() {
    return $this->user_id;
  }
  
  public function getReminderText() {
    return $this->reminder_text;
  }
  
  public function getDeleted() {
    return $this->deleted;
  }

  public function getCreateDatetime() {
    return $this->create_datetime;
  }
  
  public function getReminderDatetimes() {
    return $this->reminder_datetimes;
  }

  public function getReminderEmails() {
    return $this->reminder_emails;
  }

  public function setReminderID($reminderID) {
    $this->reminder_id = $reminderID;
  }

  public function setUserID($userID) {
    $this->user_id = $userID;
  }
  
  public function setReminderText($reminderText) {
    $this->reminder_text = $reminderText;
  }

  public function setDeleted($deleted) {
    $this->deleted = $deleted;
  }

  public function setCreateDatetime($createDatetime) {
    $this->create_datetime = $createDatetime;
  }
  
  public function setReminderDatetimes($reminderDatetimes) {
    $this->reminder_datetimes = $reminderDatetimes;
  }

  public function setReminderEmails($reminderEmails) {
    $this->reminder_emails = $reminderEmails;
  }
}
