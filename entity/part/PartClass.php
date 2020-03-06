<?php
require_once 'entity/EntityClass.php';

class PartClass extends EntityClass {
  protected $part_id;
  protected $repair_id;
  protected $description;
  protected $part_number;
  protected $source;
  protected $brand;
  protected $part_cost;
  protected $part_cost_currency;
  protected $qty;
  protected $purchase_date;
  protected $create_datetime;
  protected $notes;
  protected $deleted;

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

  public function getPartID() {
    return $this->part_id;
  }

  public function getRepairID() {
    return $this->repair_id;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getSource() {
    return $this->source;
  }

  public function getBrand() {
    return $this->brand;
  }

  public function getPartCost() {
    return $this->part_cost;
  }
  
  public function getPartCostCurrency() {
    return $this->part_cost_currency;
  }
  
  public function getQty() {
    return $this->qty;
  }

  public function getPurchaseDate() {
    return $this->purchase_date;
  }

  public function getPartNumber() {
    return $this->part_number;
  }

  public function getCreateDatetime() {
    return $this->create_datetime;
  }

  public function getNotes() {
    return $this->notes;
  }
  
  public function getDeleted() {
    return $this->deleted;
  }

  public function setPartID($partID) {
    $this->part_id = $partID;
  }

  public function setRepairID($repairID) {
    $this->repair_id = $repairID;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setSource($source) {
    $this->source = $source;
  }

  public function setBrand($brand) {
    $this->brand = $brand;
  }

  public function setPartCost($part_cost) {
    $this->part_cost = $part_cost;
  }
  
  public function setPartCostCurrency($part_cost_currency) {
    $this->part_cost_currency = $part_cost_currency;
  }

  public function setQty($qty) {
    $this->qty = $qty;
  }

  public function setPurchaseDate($purchaseDate) {
    $this->purchase_date = $purchaseDate;
  }

  public function setPartNumber($partNumber) {
    $this->part_number = $partNumber;
  }

  public function setCreateDatetime($create_datetime) {
    $this->create_datetime = $create_datetime;
  }

  public function setNotes($notes) {
    $this->notes = $notes;
  }
  
  public function setDeleted($deleted) {
    $this->deleted = $deleted;
  }
}
