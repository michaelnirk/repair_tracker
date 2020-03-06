<?php
require_once 'UIClass.php';
require_once 'DatabaseAccessClass.php';

/**
 * Description of UIControllerClass
 *
 * @author Michael Nirk
 */
class UIControllerClass {

  protected $tpl = null;
  protected $request;
  protected $messages = array(
    'errors' => array(),
    'success' => array(),
    'caution' => array()
  );
  protected $DAO = null;

  function __construct($request) {
    $this->request = $request;
    $this->tpl = new UIClass();
    $this->DAO = new DatabaseAccessClass();

    $this->tpl->assign('app_name', "It's Fixed");
    $this->tpl->assign('module', '');

    //If there is a logged in user assign the user data to a template variable
    if (isset($_SESSION['user'])) {
      $this->tpl->assign('user', json_encode($_SESSION['user']));
    }

    if (isset($this->request['debug'])) {
      $this->tpl->debugging = true;
    } else {
      $this->tpl->debugging = false;
    }

    //Get any messages that were saved in the Session
    if (isset($_SESSION['messages'])) {
      $storedMessages = json_decode($_SESSION['messages'], true);
      if (isset($storedMessages['errors'])) {
        $this->messages['errors'] = $storedMessages['errors'];
      }
      if (isset($storedMessages['errors'])) {
        $this->messages['success'] = $storedMessages['success'];
      }
      if (isset($storedMessages['errors'])) {
        $this->messages['caution'] = $storedMessages['caution'];
      }
      unset($_SESSION['messages']);
    }
  }

  // Get String value of request variables
  function sGetRequest($namen) {
    if (isset($this->request[$namen])) {
      return $this->request[$namen];
    } else {
      return "";
    }
  }

  // Get integer value of request variables
  function lGetRequest($namen) {
    if (isset($this->request[$namen])) {
      return intval($this->request[$namen]);
    } else {
      return 0;
    }
  }

  // Get float value of request variables
  function fGetRequest($namen) {
    if (isset($this->request[$namen])) {
      return floatval($this->request[$namen]);
    } else {
      return 0;
    }
  }
}
