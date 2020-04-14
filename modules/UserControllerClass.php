<?php

require_once('../include/DatabaseAccessClass.php');

class UserControllerClass extends UIControllerClass {

  //Constructor
  function __construct($request) {
    parent::__construct($request);
    $this->tpl->assign('action', $this->sGetRequest('action'));
  }

  public function execute() {
    $action = strtolower($this->sGetRequest('action'));
    switch ($action) {
      case "checkauth":
        $this->checkauth();
        break;
      case 'logout':
        $this->logout();
        break;
      case 'createaccount':
        $this->createAccount();
        break;
      case 'changepassword':
        $this->changePassword();
        break;
      case 'get_user_data':
        $this->getUserData();
        break;
    }
    $this->tpl->assign('messages', $this->messages);
    $this->tpl->display("user/login.tpl");
  }

  private function checkauth() {
    //Check if user name was sent. If so, get it. If not, add error to errorMessages array
    $userName = $this->sGetRequest('loginemail');
    if (empty($userName)) {
      $this->messages['errors'][] = 'Please enter your user name.';
    }

    //Check if password was sent. If so, get it. If not, add error to errorMessages array
    $pwd = $this->sGetRequest('loginpassword');
    if (empty($pwd)) {
      $this->messages['errors'][] = 'Please enter a your password.';
    }

    if (count($this->messages['errors']) > 0) {//Display login page with error messages
      $_SESSION['messages'] = json_encode($this->messages);
      header("Location: index.php?module=user");
      exit();
    } else {//If both user name and password are present, check if they are valid
      $user = $this->DAO->checkLogin($userName, $pwd);
      if (is_object($user)) {//Valid user
        $_SESSION['user'] = $user->getPropertiesArray();
        header('Location: index.php?module=vehicle&action=vehicles');
        exit();
      } else {
        $this->messages['errors'][] = "There are no users saved with those credentials.";
        $_SESSION['messages'] = json_encode($this->messages);
        header("Location: index.php?module=user");
        exit();
      }
    }
  }

  private function logout() {
    unset($_SESSION);
    session_unset();
    session_destroy();
    header("Location: index.php?module=user");
  }

  private function createAccount() {
    //Check if all data was supplied. If not, add error message for each
    //missing item and show login form again
    $account = array();
    if ($this->sGetRequest('firstname')) {
      $account['firstName'] = $this->sGetRequest('firstname');
    } else {
      $this->messages['errors'][] = "Please enter your first name.";
    }

    if ($this->sGetRequest('lastname')) {
      $account['lastName'] = $this->sGetRequest('lastname');
    } else {
      $this->messages['errors'][] = "Please enter your last name.";
    }

    if ($this->sGetRequest('email')) {
      $account['email'] = $this->sGetRequest('email');
    } else {
      $this->messages['errors'][] = "Please enter your email.";
    }

    if ($this->sGetRequest('password')) {
      $account['password'] = $this->sGetRequest('password');
    } else {
      $this->messages['errors'][] = "Please enter your password.";
    }

    if ($this->sGetRequest('confirmpassword')) {
      $account['confirmpassword'] = $this->sGetRequest('confirmpassword');
    } else {
      $this->messages['errors'][] = "Please reenter your password.";
    }

    if ($this->sGetRequest('password') && $this->sGetRequest('confirmpassword') && ($this->sGetRequest('password') !== $this->sGetRequest('confirmpassword'))) {
      $this->messages['errors'][] = "The two passwords do not match. Please try again.";
    }

    if (count($this->messages['errors']) > 0) {
      $_SESSION['messages'] = json_encode($this->messages);
      header("Location: index.php?module=user");
      exit();
    } else {
      $newUser = $this->DAO->createAccount($account);
      if (is_array($newUser)) {
        $_SESSION['user'] = $newUser;
        header('Location: index.php?module=vehicle&action=vehicles');
        exit();
      } else {
        $this->messages['errors'][] = "There was a problem creating your account. Please try again later.";
        $_SESSION['messages'] = json_encode($this->messages);
        header("Location: index.php?module=user");
        exit();
      }
    }
  }

  private function changePassword() {
    $oldPassword = $this->request['oldpassword'];
    $newPassword1 = $this->request['newpassword1'];
    $newPassword2 = $this->request['newpassword2'];

    if (trim($oldPassword) == '') {
      $this->errors[] = 'You must enter your old password.';
    } else if (trim($newPassword1) == '' || trim($newPassword2) == '') {
      $this->errors[] = 'You must enter your new password in both "New Password" fields.';
    } else if (trim($newPassword1) !== trim($newPassword2)) {
      $this->errors[] = 'The new passwords you have entered do not match. Please enter them again.';
    }

    if (count($this->errors) > 0) {
      $this->tpl->assign('userName', $_SESSION['user_fullname']);
      $this->tpl->assign('errors', $this->errors);
      $this->tpl->assign('content', 'showchangepassword');
    } else {
      $userArray = $this->DAO->getAccountData($_SESSION['userid']);
      if (md5($oldPassword) !== $userArray['password']) {
        $this->errors[] = 'The current password entered is incorrect. Please enter your data again.';
        $this->tpl->assign('userName', $_SESSION['user_fullname']);
        $this->tpl->assign('errors', $this->errors);
        $this->tpl->assign('content', 'showchangepassword');
      } else {
        $result = $this->DAO->changePassword($_SESSION['userid'], trim($newPassword1));
        if ($result == 1) {
          header('Location: index.php?module=Vehicle&action=listvehicles&changedpassword=1');
        } else {
          $this->errors[] = "There was a problem changing your password, Please try again.";
          $this->tpl->assign('userName', $_SESSION['user_fullname']);
          $this->tpl->assign('errors', $this->errors);
          $this->tpl->assign('content', 'showchangepassword');
        }
      }
    }
  }

  private function getUserData() {
    die(json_encode($_SESSION['user']));
  }

}
