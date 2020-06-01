<?php
/**
 * Description of Vehicle
 *
 * @author Michael Nirk
 */
require_once 'entity/EntityClass.php';

class VehicleClass extends EntityClass {

  protected $vehicle_id;
  protected $name;
  protected $make;
  protected $model;
  protected $year;
  protected $key_code;
  protected $date_purchased;
  protected $km_at_purchase;
  protected $notes;
  protected $purchase_price;
  protected $purchase_currency;
  protected $license_plate;
  protected $vin;
  protected $archived;
  protected $deleted;
  protected $user_id;
  protected $repair_count;

  public function __construct($properties = NULL) {
    parent::__construct($properties);
  }

  public function getVehicleID() {
    return $this->vehicle_id;
  }

  public function getName() {
    return $this->name;
  }

  public function getMake() {
    return $this->make;
  }

  public function getModel() {
    return $this->model;
  }

  public function getYear() {
    return $this->year;
  }

  public function getKeyCode() {
    return $this->key_code;
  }

  public function getDatePurchased() {
    return $this->date_purchased;
  }

  public function getKmAtPurchase() {
    return $this->km_at_purchase;
  }

  public function getNotes() {
    return $this->notes;
  }

  public function getPurchasePrice() {
    return $this->purchase_price;
  }

  public function getPurchaseCurrency() {
    return $this->purchase_currency;
  }

  public function getLicensePlate() {
    return $this->license_plate;
  }

  public function getVin() {
    return $this->vin;
  }
  
  public function getArchived() {
    return $this->archived;
  }
  
  public function getDeleted() {
    return $this->deleted;
  }

  public function getUserID() {
    return $this->user_id;
  }
  
  public function getRepairCount() {
    return $this->repair_count;
  }

  public function setVehicleID($vehicle_id) {
    $this->vehicle_id = $vehicle_id;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function setMake($make) {
    $this->make = $make;
  }

  public function setModel($model) {
    $this->model = $model;
  }

  public function setYear($year) {
    $this->year = $year;
  }

  public function setKeyCode($key_code) {
    $this->key_code = $key_code;
  }

  public function setDatePurchased($date_purchased) {
    $this->date_purchased = $date_purchased;
  }

  public function setKmAtPurchase($km_at_purchase) {
    $this->km_at_purchase = $km_at_purchase;
  }

  public function setNotes($notes) {
    $this->notes = $notes;
  }

  public function setPurchasePrice($purchase_price) {
    $this->purchase_price = $purchase_price;
  }

  public function setPurchaseCurrency($purchase_currency) {
    $this->purchase_currency = $purchase_currency;
  }

  public function setLicensePlate($license_plate) {
    $this->license_plate = $license_plate;
  }

  public function setVin($vin) {
    $this->vin = $vin;
  }
  
  public function setArchived($archived) {
    $this->archived = $archived;
  }
  
  public function setDeleted($deleted) {
    $this->deleted = $deleted;
  }

  public function setUserID($user_id) {
    $this->user_id = $user_id;
  }

  public function setRepairCount($repairCount) {
    $this->repair_count = $repairCount;
  }
}
