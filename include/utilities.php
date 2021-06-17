<?php

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

function sendTestEmail() {
  require_once 'include/sendMail_oauth2.php';
  $to = 'nirkules@gmail.com';
  $subject = 'Test Email using oauth';
  $body = 'This is a test email!!!';
  sendMail($to, $subject, $body);
}