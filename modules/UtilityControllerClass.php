<?php
class UtilityControllerClass extends UIControllerClass {
    //Constructor
    function __construct($request) {
        parent::__construct($request);
        $this->tpl->assign('module', 'utility');
    }
    
    function execute(){
        switch($this->request['action']){
            case 'showchangepassword':
                $this->showChangePassword();
                break;
            case 'changepassword':
                $this->changePassword();
                break;
            case 'list_currency_data':
              $this->listCurrencyData();
              break;
            case 'get_user_data':
              $this->getUserData();
              break;
            default:
                break;
        }
        
        $this->tpl->display('index.tpl');
    }
    
    private function showChangePassword(){
        $this->tpl->assign('userName', $_SESSION['user_fullname']);
        $this->tpl->assign('content', 'showchangepassword');
    } 

    private function changePassword(){
        $oldPassword = $this->request['oldpassword'];
        $newPassword1 = $this->request['newpassword1'];
        $newPassword2 = $this->request['newpassword2'];
        
        if(trim($oldPassword) == ''){
            $this->errors[] = 'You must enter your old password.';            
        } else if(trim($newPassword1) == '' || trim($newPassword2) == ''){
            $this->errors[] = 'You must enter your new password in both "New Password" fields.';            
        } else if(trim($newPassword1) !== trim($newPassword2)){
            $this->errors[] = 'The new passwords you have entered do not match. Please enter them again.';
        }
        
        if(count($this->errors) > 0){
            $this->tpl->assign('userName', $_SESSION['user_fullname']);
            $this->tpl->assign('errors', $this->errors);
            $this->tpl->assign('content', 'showchangepassword');
        } else {
            $userArray = $this->DAO->getAccountData($_SESSION['userid']);
            if(md5($oldPassword) !== $userArray['password']){
                $this->errors[] = 'The current password entered is incorrect. Please enter your data again.';
                $this->tpl->assign('userName', $_SESSION['user_fullname']);
                $this->tpl->assign('errors', $this->errors);
                $this->tpl->assign('content', 'showchangepassword');
            } else {
                $result = $this->DAO->changePassword($_SESSION['userid'], trim($newPassword1));
                if($result == 1){
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
    
    private function listCurrencyData() {
      $currencyData = $this->DAO->listCurrencyData();
      die(json_encode($currencyData));
    }
    
    private function getUserData() {
      die(json_encode($_SESSION['user']));
    }
}
