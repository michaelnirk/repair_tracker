<?php

require_once 'sendMail.php';
require_once 'DatabaseAccessClass.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}

function ajaxSuccess($data) {
  $result = array(
      'success' => true,
      'data' => $data
  );
  return json_encode($result);
}

function ajaxError($reason) {
  $result = array(
      'success' => false,
      'reason' => $reason
  );
  return json_encode($result);
}

//function processReminderEmails() {
//  $databaseAccess = new DatabaseAccessClass();
//  $reminders = $databaseAccess->getDueReminders();
//  foreach ($reminders as $reminder) {
//    sendReminderEmail($reminder);
//  }
//}
//
//function sendReminderEmail(ReminderClass $reminder) {
//  $to = $reminder->getRecipient_address();
//  $from = "info@repairtracker.com";
//  $subject = "Repair Tracker Reminder";
//  $title = $reminder->getTitle();
//  $text = $reminder->getText();
//  $vehicleName = $reminder->getVehicle_name();
//  $body = "<html>
//                <body style='font-family: sans-serif; font-size: 14px'>
//                    <div style='font-size: 18px; font-weight: bold;margin-bottom: 10px;'>
//                        $title
//                    </div>
//                    <div style='font-size:16px;'>
//                        $vehicleName has sent you a reminder!
//                    </div>
//                    <br>
//                    <div style='border-left:20px red solid;padding-left:10px;padding-top:15px;padding-bottom:15px;'>
//                        <br>$text<br>&nbsp;
//                    </div>
//                </body>
//            </html>";
//  sendMail($to, $from, $subject, $body);
//}
