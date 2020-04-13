<?php

require_once 'entity/EntityClass.php';

class ReminderDatetimeClass extends EntityClass {

  protected $remind_datetime_id;
  protected $reminder_id;
  protected $remind_datetime;
  protected $is_sent;

  public function __construct($properties = null) {
    parent::__construct($properties);
  }
  public function getRemindDatetimeID() {
    return $this->remind_datetime_id;
  }

  public function getReminderID() {
    return $this->reminder_id;
  }

  public function getRemindDatetime() {
    return $this->remind_datetime;
  }

  public function getIsSent() {
    return $this->is_sent;
  }

  public function setRemindDatetimeID($remindDatetimeID) {
    $this->remind_datetime_id = $remindDatetimeID;
  }

  public function setReminderID($reminderID) {
    $this->reminder_id = $reminderID;
  }

  public function setRemindDatetime($remindDatetime) {
    $this->remind_datetime = $remindDatetime;
  }

  public function setIsSent($isSent) {
    $this->is_sent = $isSent;
  }
}
