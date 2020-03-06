<?php
require_once 'entity/part/PartClass.php';
require_once 'entity/NoteClass.php';

class PartControllerClass extends UIControllerClass {

  //Constructor
  function __construct($request) {
    parent::__construct($request);
    $this->tpl->assign('module', 'part');
    $this->tpl->assign('action', $this->request['action']);
  }

  function execute() {
    switch ($this->request['action']) {
      case 'parts':
        $this->showParts();
        break;
      case 'delete_part':
        $this->deletePart();
        break;
      case 'set_part':
        $this->setPart();
        break;
    }
    $this->tpl->assign('messages', $this->messages);
    $this->tpl->display('index.tpl');
  }
  
  private function showParts() {
    $repairID = $this->request['repair_id'];
    $parts = $this->DAO->listParts($repairID);
    foreach($parts as &$part) {
      $part = $part->getPropertiesArray();
    }
    $repair = $this->DAO->getRepair($repairID);
    $vehicle = $this->DAO->getVehicle($repair->getVehicleID());
    $this->tpl->assign('pageTitle', $vehicle->getName() . " - Repair Parts");
    $this->tpl->assign('vehicle', $vehicle->getPropertiesArray());
    $this->tpl->assign('repair', $repair->getPropertiesArray());
    $this->tpl->assign('parts', $parts);
    $this->tpl->assign('content', 'parts');
  }

  private function setPart() {
    $partID = $this->lGetRequest('part_id') ?: "";
    $repairID = $this->lGetRequest("repair_id");
    $description = $this->sGetRequest('description') ? test_input($this->sGetRequest('description')) : "";
    if (empty($description)) {
      $this->messages[errors][] = "Please enter a part description.";
    }
    $qty = $this->sGetRequest('qty') ? test_input($this->sGetRequest('qty')) : "";
    if (empty($qty)) {
      $this->messages[errors][] = "Please enter a part quantity.";
    }
    
    if (count($this->messages['errors'])) {
      die(ajaxError($this->messages));
    }

    $partNumber = $this->sGetRequest('part_number') ? test_input($this->sGetRequest('part_number')) : "";
    $source = $this->sGetRequest('source') ? test_input($this->sGetRequest('source')) : "";
    $brand = $this->sGetRequest('brand') ? test_input($this->sGetRequest('brand')) : "";
    $partCost = $this->sGetRequest('part_cost') ? test_input($this->sGetRequest('part_cost')) : "";
    $partCostCurrency = $this->lGetRequest('part_cost_currency') ? test_input($this->lGetRequest('part_cost_currency')) : "";
    $purchaseDate = $this->sGetRequest('purchase_date') ? test_input($this->sGetRequest('purchase_date')) : "";
    $part = new PartClass();
    $part->setPartID($partID);
    $part->setRepairID($repairID);
    $part->setDescription($description);
    $part->setPartNumber($partNumber);
    $part->setSource($source);
    $part->setBrand($brand);
    $part->setPartCost($partCost);
    $part->setPartCostCurrency($partCostCurrency);
    $part->setQty($qty);
    $part->setPurchaseDate($purchaseDate);
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
      $part->setNotes($noteObjects);
    }
    
    $result = $this->DAO->setPart($part);
    //Based on result, add appropriate message or error
    if (is_numeric($result) && $result > 0) {
      $part = $this->DAO->getPart($result);
      die(ajaxSuccess($part->getPropertiesArray()));
    } else {
      $this->messages['errors'][] = $partID ? "There was a problem updating the part information. Please try again later." : "There was a problem creating the part. Please try again later.";
      die(ajaxError($this->messages));
    }
  }

  private function deletePart() {
    $partID = $this->request['part_id'];
    if ($this->DAO->deletePart($partID) === $partID) {
      die(ajaxSuccess($partID));
    } else {
      $this->messages['errors'][] = "There was a problem deleting the part. Please try again later.";
      die(ajaxError($this->messages));
    }
  }
}
