<?php

require_once 'entity/NoteClass.php';

class ReminderControllerClass extends UIControllerClass {

  //Constructor
  function __construct($request) {
    parent::__construct($request);
    $this->tpl->assign('module', 'reminder');
    $this->tpl->assign('action', $this->request['action']);
  }

  public function execute() {
    $action = $this->request['action'];

    switch ($action) {
      case 'reminders':
        $this->showReminders();
        break;
      case 'delete_reminder':
        $this->deleteReminder();
        break;
      case 'set_reminder':
        $this->setReminder();
        break;
    }
    $this->tpl->assign('messages', $this->messages);
    $this->tpl->display("index.tpl");
  }

  private function showReminders() {
    $reminders = $this->DAO->listReminders();
//    die(var_dump($reminders));
    foreach ($reminders as &$reminder) {
      $reminder = $reminder->getPropertiesArray();
    }
    $this->tpl->assign('reminders', $reminders);
    $this->tpl->assign('pageTitle', "Manage Reminders");
    $this->tpl->assign('content', 'reminders');
  }

  private function setReminder() {
    require_once 'entity/reminder/ReminderClass.php';
    require_once 'entity/reminder/ReminderDatetimeClass.php';
    require_once 'entity/reminder/ReminderEmailClass.php';
    $reminderID = $this->request['reminder_id'] ? test_input($this->request['reminder_id']) : "";
    $reminderText = $this->request['reminder_text'] ? test_input($this->request['reminder_text']) : "";
    if (empty($reminderText)) {
      $this->messages['errors'][] = "Please enter reminder text.";
    }
    $reminderEmails = $this->request['reminder_emails'];
    if (empty($reminderEmails)) {
      $this->messages['errors'][] = "Please enter at least 1 emails address.";
    }
    $reminderDatetimes = $this->sGetRequest('reminder_datetimes');
    if (empty($reminderDatetimes)) {
      $this->messages['errors'][] = "Please select at least 1 remider date and time.";
    }
    if (count($this->messages['errors'])) {
      die(ajaxError($this->messages));
    }
    $reminder = new ReminderClass();
    $reminder->setUserID($_SESSION['user']['user_id']);
    $reminder->setReminderText($reminderText);
    $reminder->setReminderID($reminderID);
    $reminderEmailObjects = array();
    foreach ($reminderEmails as $reminderEmail) {
      $emailObject = new ReminderEmailClass();
      $emailObject->setEmail($reminderEmail);
      $reminderEmailObjects[] = $emailObject;
    }
    $reminder->setReminderEmails($reminderEmailObjects);
    $reminderDatetimeObjects = array();
    foreach (json_decode($reminderDatetimes, true) as $reminderDatetime) {
      $reminderDatetimeObject = new ReminderDatetimeClass($reminderDatetime);
      $reminderDatetimeObjects[] = $reminderDatetimeObject;
    }
    $reminder->setReminderDatetimes($reminderDatetimeObjects);
    $result = $this->DAO->setReminder($reminder);
    //Based on result, add appropriate message or error
    if (is_numeric($result) && $result > 0) {
      $reminder = $this->DAO->getReminder($result);
      die(ajaxSuccess($reminder->getPropertiesArray()));
    } else {
      $this->messages['errors'][] = $reminderID ? "There was a problem updating the reminder. Please try again later." : "There was a problem creating the reminder. Please try again later.";
      die(ajaxError($this->messages));
    }
  }

  private function deleteReminder() {
    $reminderID = $this->request['reminder_id'];
    if ($this->DAO->deleteReminder($reminderID) === $reminderID) {
      die(ajaxSuccess($reminderID));
    } else {
      $this->messages['errors'][] = "There was a problem deleting the reminder. Please try again later.";
      die(ajaxError($this->messages));
    }
  }

}
