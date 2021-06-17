<?php

require_once 'include/DatabaseAccessClass.php';

class UtilityControllerClass {
  private $request;
  private $DAO;

  //Constructor
  function __construct($request = NULL) {
    $this->request = $request;
    $this->DAO = new DatabaseAccessClass();
  }

  function execute() {
    switch ($this->request['action']) {
      case 'list_currency_data':
        $this->listCurrencyData();
        break;
    }
  }

  private function listCurrencyData() {
    $currencyData = $this->DAO->listCurrencyData();
    die(json_encode($currencyData));
  }
  
  public function processDueReminders() {
    require_once 'include/sendMail_oauth2.php';
    $subject = "Repair Tracker Reminder!";
    //Get all due reminders
    $dueReminders = $this->DAO->listDueReminders();
    //Iterate throught all due reminders. Gather all email addresses and sent the email
    foreach($dueReminders as $dueReminder) {
      $reminderEmails = $dueReminder->getReminderEmails();
      $emails = array();
      foreach($reminderEmails as $reminderEmail) {
        $emails[] = $reminderEmail->getEmail();
      }
      $body = "<html><body style='font-size=12px;'><h2>A reminder from Repair Tracker!</h2><br>
             <em>" . $dueReminder->getReminderText() . "</em></body></html>";
      sendMail($emails, $subject, utf8_decode($body));
      //Set remind dateteimes to sent
      $remindDatetimes = $dueReminder->getReminderDatetimes();
      foreach($remindDatetimes as $remindDatetime) {
        if (!$remindDatetime->getIsSent()) {
          $now = new DateTime();
          $sendDatetime = new DateTime($remindDatetime->getRemindDatetime());
          if ($sendDatetime < $now) {
            $this->DAO->setReminderDatetimeToSent($remindDatetime->getRemindDatetimeID());
          }
        }
      }
    }
  }
}
