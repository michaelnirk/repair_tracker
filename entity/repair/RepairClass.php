<?php

require_once 'entity/EntityClass.php';

class RepairClass extends EntityClass {

  protected $repair_id;
  protected $vehicle_id;
  protected $km_at_repair;
  protected $repair_date;
  protected $description;
  protected $repair_location;
  protected $repair_cost;
  protected $repair_cost_currency;
  protected $create_datetime;
  protected $notes;
  protected $part_count;

  public function __construct($properties = null) {
    if ($properties) {
      $reflection = new ReflectionClass(get_class($this));
      $classProps = $reflection->getProperties();
      foreach ($classProps as $prop) {
        $propName = $prop->getName();
        if (isset($properties[$propName])) {
          $this->$propName = $properties[$propName];
        }
      }
    }
  }

  public function getRepairID() {
    return $this->repair_id;
  }

  public function getVehicleID() {
    return $this->vehicle_id;
  }

  public function getKmAtRepair() {
    return $this->km_at_repair;
  }

  public function getRepairDate() {
    return $this->repair_date;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getRepairLocation() {
    return $this->repair_location;
  }

  public function getRepairCost() {
    return $this->repair_cost;
  }

  public function getRepairCostCurrency() {
    return $this->repair_cost_currency;
  }

  public function getCreateDatetime() {
    return $this->create_datetime;
  }

  public function getNotes() {
    return $this->notes;
  }

  public function getPartCount() {
    return $this->part_count;
  }

  public function setRepairID($repairID) {
    $this->repair_id = $repairID;
  }

  public function setVehicleID($vehicleID) {
    $this->vehicle_id = $vehicleID;
  }

  public function setKmAtRepair($kmAtRepair) {
    $this->km_at_repair = $kmAtRepair;
  }

  public function setRepairDate($repairDate) {
    $this->repair_date = $repairDate;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setRepairLocation($repairLocation) {
    $this->repair_location = $repairLocation;
  }

  public function setRepairCost($repairCost) {
    $this->repair_cost = $repairCost;
  }

  public function setRepairCostCurrency($repair_cost_currency) {
    $this->repair_cost_currency = $repair_cost_currency;
  }

  public function setCreateDatetime($create_datetime) {
    $this->create_datetime = $create_datetime;
  }

  public function setNotes($notes) {
    $this->notes = $notes;
  }

  public function setPartCount($partCount) {
    $this->part_count = $partCount;
  }

}
