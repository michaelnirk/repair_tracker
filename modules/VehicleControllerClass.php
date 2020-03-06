<?php

require_once 'entity/vehicle/VehicleClass.php';
require_once 'entity/NoteClass.php';

class VehicleControllerClass extends UIControllerClass {

  //Constructor
  function __construct($request) {
    parent::__construct($request);
    $this->tpl->assign('module', 'vehicle');
    $this->tpl->assign('action', $this->request['action']);
  }

  public function execute() {
    $action = $this->request['action'];

    switch ($action) {
      case 'vehicles':
        $this->showVehicles();
        break;
      case 'delete_vehicle':
        $this->deleteVehicle();
        break;
      case 'set_vehicle':
        $this->setVehicle();
        break;
    }
    $this->tpl->assign('messages', $this->messages);
    $this->tpl->display("index.tpl");
  }

  private function showVehicles() {
    if (!empty($_SESSION['isNewAccount'])) {
      $this->messages['success'][] = "Your account has been successfully created. Welcome to Repair Tracker!";
      unset($_SESSION['isNewAccount']);
    }
    if (isset($this->request['changedpassword'])) {
      $this->messages['success'][] = "Your password has been successfully changed.";
    }
    $vehicles = $this->DAO->listVehicles();
    foreach($vehicles as &$vehicle) {
      $vehicle = $vehicle->getPropertiesArray();
    }
    $this->tpl->assign('vehicles', $vehicles);
    $this->tpl->assign('pageTitle', "Saved Vehicles");
    $this->tpl->assign('content', 'vehicles');
  }

  private function deleteVehicle() {
    $vehicleID = $this->request['vehicle_id'];
    if ($this->DAO->deleteVehicle($vehicleID) === $vehicleID) {
      die(ajaxSuccess($vehicleID));
    } else {
      $this->messages['errors'][] = "There was a problem deleting the vehicle information. Please try again later.";
      die(ajaxError($this->messages));
    }
  }

  private function setVehicle() {
    $vehicleID = $this->request['vehicle_id'] ? test_input($this->request['vehicle_id']) : "";
    $name = $this->request['name'] ? test_input($this->request['name']) : "";
    if (empty($name)) {
      $this->messages['errors'][] = "Please enter a vehicle name.";
    }
    $make = $this->request['make'] ? test_input($this->request['make']) : "";
    $model = $this->request['model'] ? test_input($this->request['model']) : "";
    $year = $this->request['year'] ? test_input($this->request['year']) : "";
    $keyCode = $this->request['key_code'] ? test_input($this->request['key_code']) : "";
    $datePurchased = $this->request['date_purchased'] ? test_input($this->request['date_purchased']) : "";
    $kmAtPurchase = $this->request['km_at_purchase'] ? test_input($this->request['km_at_purchase']) : "";
    $purchasePrice = $this->request['purchase_price'] ? test_input($this->request['purchase_price']) : "";
    $purchaseCurrency = isset($this->request['purchase_currency']) ? test_input($this->request['purchase_currency']) : "";
    $licensePlate = $this->request['license_plate'] ? test_input($this->request['license_plate']) : "";
    $vin = $this->request['vin'] ? test_input($this->request['vin']) : "";

    if (count($this->messages['errors'])) {
      die(ajaxError($this->messages));
    }
    $vehicle = new VehicleClass();
    $vehicle->setVehicleID($vehicleID);
    $vehicle->setName($name);
    $vehicle->setMake($make);
    $vehicle->setModel($model);
    $vehicle->setYear($year);
    $vehicle->setKeyCode($keyCode);
    $vehicle->setDatePurchased($datePurchased);
    $vehicle->setKmAtpurchase($kmAtPurchase);
    $vehicle->setPurchasePrice($purchasePrice);
    $vehicle->setPurchaseCurrency($purchaseCurrency);
    $vehicle->setLicensePlate($licensePlate);
    $vehicle->setVin($vin);
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
      $vehicle->setNotes($noteObjects);
    }
    $result = $this->DAO->setVehicle($vehicle);
    //Based on result, add appropriate message or error
    if (is_numeric($result) && $result > 0) {
      $vehicle = $this->DAO->getVehicle($result);
      die(ajaxSuccess($vehicle->getPropertiesArray()));
    } else {
      $this->messages['errors'][] = $vehicleID ? "There was a problem updating the vehicle information. Please try again later." : "There was a problem creating the vehicle. Please try again later.";
      die(ajaxError($this->messages));
    }
  }
}
