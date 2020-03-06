<?php
/**
 * Description of AppControllerClass
 *
 * @author Michael Nirk
 */
class AppControllerClass extends UIControllerClass {
    
    function execute(){
        $action = $this->sGetRequest('action');
        switch($action){
            case 'login':
                break;
            case 'list_vehicles':
                $this->listVehicles();
                break;
            case 'view_edit_vehicle':
                break;
            case 'list_repairs':
                break;
            case 'view_edit_repair':
                break;
            case 'list_parts':
                break;
            case 'view_edit_part':
                break;
            default:
                break;
        }
        $this->tpl->display('index.tpl');
    }
}
