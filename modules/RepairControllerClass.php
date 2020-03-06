<?php

require_once 'entity/repair/RepairClass.php';
require_once 'entity/NoteClass.php';

class RepairControllerClass extends UIControllerClass {

  //Constructor
  function __construct($request) {
    parent::__construct($request);
    $this->tpl->assign('module', 'repair');
    $this->tpl->assign('action', $this->request['action']);
  }

  function execute() {
    switch ($this->request['action']) {
      case 'repairs':
        $this->showRepairs();
        break;
      case 'delete_repair':
        $this->deleteRepair();
        break;
      case 'set_repair':
        $this->setRepair();
        break;
    }
    $this->tpl->assign('messages', $this->messages);
    $this->tpl->display('index.tpl');
  }
  
  private function showRepairs() {
    $vehicleID = $this->request['vehicle_id'];
    $repairs = $this->DAO->listRepairs($vehicleID);
    foreach($repairs as &$repair) {
      $repair = $repair->getPropertiesArray();
    }
    $vehicle = $this->DAO->getVehicle($vehicleID);
    $this->tpl->assign('pageTitle', $vehicle->getName() . " - Repairs");
    $this->tpl->assign('vehicle', $vehicle->getPropertiesArray());
    $this->tpl->assign('repairs', $repairs);
    $this->tpl->assign('content', 'repairs');
  }

  private function setRepair() {
    $repairID = $this->lGetRequest('repair_id') ?: "";
    $vehicleID = $this->lGetRequest("vehicle_id");
    $repairDate = $this->sGetRequest('repair_date') ? test_input($this->sGetRequest('repair_date')) : "";
    if (empty($repairDate)) {
      $this->messages[errors][] = "Please select a repair date.";
    }
    $description = $this->sGetRequest('description') ? test_input($this->sGetRequest('description')) : "";
    if (empty($description)) {
      $this->messages[errors][] = "Please enter a repair description.";
    }
    
    if (count($this->messages['errors'])) {
      die(ajaxError($this->messages));
    }

    $kmAtRepair = $this->sGetRequest('km_at_repair') ? test_input($this->sGetRequest('km_at_repair')) : "";
    $repairLocation = $this->sGetRequest('repair_location') ? test_input($this->sGetRequest('repair_location')) : "";
    $repairCost = $this->sGetRequest('repair_cost') ? test_input($this->sGetRequest('repair_cost')) : "";
    $repairCostCurrency = $this->sGetRequest('repair_cost_currency') ? test_input($this->lGetRequest('repair_cost_currency')) : "";
    $repair = new RepairClass();
    $repair->setRepairID($repairID);
    $repair->setVehicleID($vehicleID);
    $repair->setRepairDate($repairDate);
    $repair->setDescription($description);
    $repair->setKmAtRepair($kmAtRepair);
    $repair->setRepairLocation($repairLocation);
    $repair->setRepairCost($repairCost);
    $repair->setRepairCostCurrency($repairCostCurrency);
    /*
     * Process any notes, if present
     */
    $notesJSON = $this->sGetRequest('notes');
    if ($notesJSON) {
      $notes = json_decode($notesJSON, true);
      $noteObjects = array();
      foreach ($notes as $noteArray) {
        $noteArray['note_text'] = test_input($noteArray['note_text']);
        $note = new NoteClass($noteArray);
        $noteObjects[] = $note;
      }
      $repair->setNotes($noteObjects);
    }
    
    $result = $this->DAO->setRepair($repair);
    //Based on result, add appropriate message or error
    if (is_numeric($result) && $result > 0) {
      $repair = $this->DAO->getRepair($result);
      die(ajaxSuccess($repair->getPropertiesArray()));
    } else {
      $this->messages['errors'][] = $repairID ? "There was a problem updating the repair information. Please try again later." : "There was a problem creating the repair. Please try again later.";
      die(ajaxError($this->messages));
    }
  }

  private function deleteRepair() {
    $repairID = $this->request['repair_id'];
    if ($this->DAO->deleteRepair($repairID) === $repairID) {
      die(ajaxSuccess($repairID));
    } else {
      $this->messages['errors'][] = "There was a problem deleting the repair. Please try again later.";
      die(ajaxError($this->messages));
    }
  }
}
