<?php

/**
 * Description of DatabaseAccessClass
 *
 * @author Michael Nirk
 */
include_once 'entity/vehicle/VehicleClass.php';
include_once 'entity/repair/RepairClass.php';
include_once 'entity/part/PartClass.php';

class DatabaseAccessClass {

  private $conn;
  private $stmt;

  //Function to create database connection
  function getConnection() {
    try {
      //        $this->conn = new PDO("mysql:host=localhost;dbname=repair_tracker;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_FOUND_ROWS => true));
      $this->conn = new PDO("mysql:host=192.168.178.26;dbname=repair_tracker;charset=utf8", "repairtracker", "eLGe6yVVHscyZoU4", array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_FOUND_ROWS => true));

      //$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_FOUND_ROWS => true);
    } catch (PDOException $ex) {
      echo "An error occurred while connecting to the database: " . $ex->getMessage();
    }
    return $this->conn;
  }

  //Function to close database connection
  private function cleanUp() {
    $this->stmt = null;
    $this->conn = null;
  }

  public function createEntity($type) {
    $this->getConnection();
    $sql = "INSERT INTO entities (
              entity_type
            ) VALUES (
              :type
            )";
    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->bindParam(':type', $type);
    $this->stmt->execute();
    $newEntityID = $this->conn->lastInsertId();
    $this->cleanUp();
    return $newEntityID;
  }

  //Function to login in user
  public function checkLogin($userEmail, $userPwd) {
    $this->getConnection();

    $password = md5($userPwd);

    $sql = "SELECT * FROM users_t WHERE email = :email AND password = :password LIMIT 1";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':email', $userEmail);
    $this->stmt->bindParam(':password', $password);

    $this->stmt->execute();


    if ($this->stmt->rowCount() === 1) {
      $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
      $user = $this->getUser($row['user_id']);

      //Close statement and connection
      $this->cleanUp();
      return $user;
    } else {
      //Close statement and connection
      $this->cleanUp();
      return -1;
    }
  }

  public function createAccount($account) {
    //Create connection to database
    $this->getConnection();

    //Get the new ID
    $userID = $this->createEntity(1);

    //Create password from username and password
    $password = md5($account['password']);

    //sql for query
    $sql = "INSERT INTO users_t (
              user_id,
              first_name,
              last_name,
              email,
              password
           ) VALUES (
              :user_id,
              :first_name,
              :last_name,
              :email,
              :password
           )";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $this->stmt->bindParam(':first_name', $account['firstName'], PDO::PARAM_STR);
    $this->stmt->bindParam(':last_name', $account['lastName'], PDO::PARAM_STR);
    $this->stmt->bindParam(':email', $account['email'], PDO::PARAM_STR);
    $this->stmt->bindParam(':password', $password, PDO::PARAM_STR);

    $this->stmt->execute();

    if ($this->stmt->rowCount() == 1) {
      $result = array(
          'userID' => $userID,
          'firstName' => $account['firstName'],
          'lastName' => $account['lastName']
      );
    } else {
      $result = -1;
    }
    //Close statement and connection
    $this->cleanUp();
    return $result;
  }

  public function getUser($userID) {
    require_once 'entity/UserClass.php';
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "SELECT u.user_id,
                   u.first_name,
                   u.last_name,
                   u.email,
                   e.create_datetime
            FROM users_t AS u
            INNER JOIN entities AS e
              ON e.entity_id = u.user_id
            WHERE u.user_id = :userID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

    $this->stmt->execute();

    $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
    $user = new UserClass($result);
    $this->cleanUp();
    return $user;
  }

  //Function to return a list of vehicles for the current user
  public function listVehicles() {
    $userID = $_SESSION['user']['user_id'];
    //Create connection to database
    $this->getConnection();
    //SQL for query
    $sql = "SELECT vehicle_id,
                   name,
                   make,
                   model,
                   date_purchased,
                   km_at_purchase,
                   purchase_price,
                   purchase_currency,
                   key_code,
                   year,
                   vin,
                   license_plate
             FROM vehicle_t 
             WHERE user_id = :id AND deleted = 0";

    $this->stmt = $this->conn->prepare($sql);
    //Bind parameters
    $this->stmt->bindParam(':id', $userID, PDO::PARAM_INT);

    $this->stmt->execute();

    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    $vehicles = array();
    //Get all vehicle counts
    $repairCounts = $this->listVehicleRepairCounts();

    foreach ($result as $row) {
      $vehicle = new VehicleClass($row);
      $vehicleNotes = $this->listNotes($row['vehicle_id']);
      $vehicle->setNotes($vehicleNotes);
      $vehicle->setRepairCount(array_key_exists($vehicle->getVehicleID(), $repairCounts) ? $repairCounts[$vehicle->getVehicleID()] : 0);
      $vehicles[] = $vehicle;
    }
    //Close statement and connection
    $this->cleanUp();
    //Return array of vehicles
    return $vehicles;
  }

  //Function to delete a vehicle for the current user
  public function deleteVehicle($vehicleID) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "UPDATE vehicle_t SET
              deleted = 1
            WHERE vehicle_ID = :vID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':vID', $vehicleID, PDO::PARAM_INT);

    $this->stmt->execute();

    if ($this->stmt->rowCount() == 1) {
      $result = $vehicleID;
    } else {
      $result = -1;
    }
    //Close statement and connection
    $this->cleanUp();
    return $result;
  }

  public function getVehicle($vehID) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "SELECT vehicle_id,
                   name,
                   make,
                   model,
                   year,
                   key_code,
                   date_purchased,
                   km_at_purchase,
                   purchase_price,
                   purchase_currency,
                   license_plate,
                   vin
            FROM vehicle_t 
            WHERE vehicle_ID = :vID LIMIT 1";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':vID', $vehID);

    $this->stmt->execute();

    $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
    $vehicle = new VehicleClass($result);
    $vehicleNotes = $this->listNotes($vehicle->getVehicleID());
    $vehicle->setNotes($vehicleNotes);
    //Get the repair count for the vehicle
    $repairCounts = $this->listVehicleRepairCounts();
    $vehicle->setRepairCount(array_key_exists($vehID, $repairCounts) ? $repairCounts[$vehID] : 0);

    $this->cleanUp();
    return $vehicle;
  }

  public function setVehicle(VehicleClass $vehicle) {
    if ($vehicle->getVehicleID()) {
      $vehicleID = $vehicle->getVehicleID();
      $this->updateVehicle($vehicle);
    } else {
      $vehicleID = $this->createVehicle($vehicle);
    }
    if ($vehicle->getNotes()) {
      $notes = $vehicle->getNotes();
      foreach ($notes as $note) {
        $note->setParentID($vehicleID);
      }
      $this->setNotes($notes);
    }
    return $vehicleID;
  }

  private function createVehicle(VehicleClass $vehicle) {
    $vehicleID = $this->createEntity(2);
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "INSERT INTO vehicle_t (
              vehicle_id,
              name,
              make,
              model,
              year,
              key_code,
              date_purchased,
              km_at_purchase,
              purchase_price,
              purchase_currency,
              license_plate,
              vin,
              user_id
            ) VALUES (
              :vehicleID,
              :name,
              :make,
              :model,
              :year,
              :keyCode,
              :datePurchased,
              :kmAtPurchase,
              :purchasePrice,
              :purchaseCurrency,
              :licensePlate,
              :vin,
              :userID
            )";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':vehicleID', $vehicleID, PDO::PARAM_INT);
    $this->stmt->bindParam(':name', $vehicle->getName(), PDO::PARAM_STR);
    $this->stmt->bindParam(':make', $vehicle->getMake(), empty($vehicle->getMake()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':model', $vehicle->getModel(), empty($vehicle->getModel()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':year', $vehicle->getYear(), empty($vehicle->getYear()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':keyCode', $vehicle->getKeyCode(), empty($vehicle->getKeyCode()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':datePurchased', $vehicle->getDatePurchased(), empty($vehicle->getDatePurchased()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':kmAtPurchase', $vehicle->getKmAtPurchase(), empty($vehicle->getKmAtPurchase()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':purchasePrice', $vehicle->getPurchasePrice(), empty($vehicle->getPurchasePrice()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':purchaseCurrency', $vehicle->getPurchaseCurrency(), empty($vehicle->getPurchaseCurrency()) ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $this->stmt->bindParam(':licensePlate', $vehicle->getLicensePlate(), empty($vehicle->getLicensePlate()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':vin', $vehicle->getVin(), empty($vehicle->getVin()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindParam(':userID', $_SESSION['user']['user_id'], PDO::PARAM_INT);

    if ($this->stmt->execute()) {
      $result = $vehicleID;
    } else {
      $result = -1;
    }
    $this->cleanUp();
    return $result;
  }

  private function updateVehicle(VehicleClass $vehicle) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "UPDATE vehicle_t SET
                   name = :name,
                   make = :make,
                   model = :model,
                   year = :year,
                   key_code = :keyCode,                    
                   km_at_purchase = :kmAtPurchase,
                   purchase_price = :purchasePrice,
                   purchase_currency = :purchaseCurrency,
                   license_plate = :licensePlate,
                   vin = :vin,
                   date_purchased = :datePurchased
            WHERE vehicle_ID = :vehicleID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindValue(':name', $vehicle->getName(), PDO::PARAM_STR);
    $this->stmt->bindValue(':make', $vehicle->getMake(), empty($vehicle->getMake()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':model', $vehicle->getModel(), empty($vehicle->getModel()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':year', $vehicle->getYear(), empty($vehicle->getYear()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':keyCode', $vehicle->getKeyCode(), empty($vehicle->getKeyCode()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':datePurchased', $vehicle->getDatePurchased(), empty($vehicle->getDatePurchased()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':kmAtPurchase', $vehicle->getKmAtpurchase(), empty($vehicle->getKmAtPurchase()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':purchasePrice', $vehicle->getPurchasePrice(), empty($vehicle->getPurchasePrice()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':purchaseCurrency', $vehicle->getPurchaseCurrency(), empty($vehicle->getPurchaseCurrency()) ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $this->stmt->bindValue(':licensePlate', $vehicle->getLicensePlate(), empty($vehicle->getLicensePlate()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':vin', $vehicle->getVin(), empty($vehicle->getVin()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':vehicleID', $vehicle->getVehicleId(), PDO::PARAM_INT);
    $this->stmt->execute();

    if ($this->stmt->rowCount() === 1) {
      $result = 1;
    } else {
      $result = -1;
    }
    $this->cleanUp();
    return $result;
  }

  private function listVehicleRepairCounts() {
    //Create connection to database
    $this->getConnection();
    //SQL for query
    $sql = "SELECT v.vehicle_id, COUNT(r.repair_id) as repair_count
            FROM vehicle_t v 
            INNER JOIN repair_t r 
              ON r.vehicle_id = v.vehicle_id 
            GROUP BY vehicle_id";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->execute();

    $repairCounts = array();
    $results = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $item) {
      $repairCounts[$item['vehicle_id']] = $item['repair_count'];
    }

    //Close statement and connection
    $this->cleanUp();
    //Return results
    return $repairCounts;
  }

  private function listNotes($parentID) {
    require_once 'entity/NoteClass.php';
    //Create connection to database
    $this->getConnection();
    //SQL for query
    $sql = "SELECT n.note_id,
                   n.note_text,
                   n.parent_id,
                   e.create_datetime
            FROM notes n 
            INNER JOIN entities e
              ON e.entity_id = n.note_id
            WHERE n.parent_id = :parentID";

    $this->stmt = $this->conn->prepare($sql);
    //Bind parameters
    $this->stmt->bindParam(':parentID', $parentID, PDO::PARAM_INT);

    $this->stmt->execute();

    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    $notes = array();

    foreach ($result as $row) {
      $note = new NoteClass($row);
      $notes[] = $note;
    }
    //Close statement and connection
    $this->cleanUp();
    //Return array of vehicles
    return $notes;
  }

  public function setNotes(array $notes) {
    foreach ($notes as $note) {
      if ($note->getNoteID()) {
        $this->updateNote($note);
      } else {
        $this->createNote($note);
      }
    }
  }

  private function createNote(NoteClass $note) {
    $noteID = $this->createEntity(5);
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "INSERT INTO notes (
              note_id,
              note_text,
              parent_id
            ) VALUES (
              :noteID,
              :noteText,
              :parentID
            )";

    $this->stmt = $this->conn->prepare($sql);

    $noteText = $note->getNoteText();
    $parentID = $note->getParentID();

    $this->stmt->bindParam(':noteID', $noteID, PDO::PARAM_INT);
    $this->stmt->bindParam(':noteText', $noteText, PDO::PARAM_STR);
    $this->stmt->bindParam(':parentID', $parentID, PDO::PARAM_INT);

    $this->stmt->execute();
    $this->cleanUp();
  }

  private function updateNote(NoteClass $note) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "UPDATE notes SET
              note_text = :noteText
            WHERE note_id = :noteID";

    $this->stmt = $this->conn->prepare($sql);

    $noteText = $note->getNoteText();
    $noteID = $note->getNoteID();

    $this->stmt->bindParam(':noteID', $noteID, PDO::PARAM_INT);
    $this->stmt->bindParam(':noteText', $noteText, PDO::PARAM_STR);

    $this->stmt->execute();
    $this->cleanUp();
  }

  public function listRepairs($vehicleID) {
    //Array to hold all repairs
    $repairs = array();
    //Create connection to database
    $this->getConnection();
    //SQL for query
    $sql = "SELECT r.repair_id,
                   r.vehicle_id,
                   r.repair_date,
                   r.km_at_repair,
                   r.description,
                   r.repair_location,
                   r.repair_cost,
                   r.repair_cost_currency,
                   COUNT(p.part_id) AS parts_count,
                   e.create_datetime
            FROM repair_t AS r
            INNER JOIN entities AS e
              ON e.entity_id = r.repair_id
            LEFT JOIN part_t AS p ON
                r.repair_id = p.repair_id
            WHERE r.deleted = 0 AND r.vehicle_id = :vID
            GROUP BY r.repair_id
            ORDER BY r.repair_date desc";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':vID', $vehicleID);

    $this->stmt->execute();

    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    //Get all vehicle counts
    $partCounts = $this->listRepairPartCounts();
    foreach ($result as $repairRow) {
      $repair = new RepairClass($repairRow);
      $repair->setNotes($this->listNotes($repair->getRepairID()));
      $repair->setPartCount(array_key_exists($repair->getRepairID(), $partCounts) ? $partCounts[$repair->getRepairID()] : 0);
      $repairs[] = $repair;
    }

    $this->cleanUp();

    return $repairs;
  }

  public function getRepair($repairID) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "SELECT r.repair_id,
                   r.vehicle_id,
                   r.repair_date,
                   r.km_at_repair,
                   r.description,
                   r.repair_location,
                   r.repair_cost,
                   r.repair_cost_currency,
                   e.create_datetime
            FROM repair_t AS r
            INNER JOIN entities AS e
              ON e.entity_id = r.repair_id
            WHERE repair_ID = :rID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':rID', $repairID);

    $this->stmt->execute();

    $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
    $repair = new RepairClass($result);
    $repair->setNotes($this->listNotes($repairID));
    //Get the part count for the vehicle
    $partCounts = $this->listRepairPartCounts();
    $repair->setPartCount(array_key_exists($repairID, $partCounts) ? $partCounts[$repairID] : 0);

    $this->cleanUp();
    return $repair;
  }

  public function setRepair(RepairClass $repair) {
    if ($repair->getRepairID()) {
      $repairID = $this->updateRepair($repair);
    } else {
      $repairID = $this->createRepair($repair);
    }
    if ($repair->getNotes()) {
      $notes = $repair->getNotes();
      foreach ($notes as $note) {
        $note->setParentID($repairID);
      }
      $this->setNotes($notes);
    }
    return $repairID;
  }

  private function createRepair(RepairClass $repair) {
    $repairID = $this->createEntity(3);
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "INSERT INTO repair_t (
              repair_id,
              vehicle_id,
              repair_date,
              km_at_repair,
              description,
              repair_location,
              repair_cost,
              repair_cost_currency
           ) VALUES (
              :repairID,
              :vehicleID,
              :repairDate,
              :kmAtRepair,
              :description,
              :location,
              :repairCost,
              :repairCostCurrency
           )";

    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->bindValue(':repairID', $repairID, PDO::PARAM_INT);
    $this->stmt->bindValue(':vehicleID', $repair->getVehicleID(), PDO::PARAM_INT);
    $this->stmt->bindValue(':repairDate', $repair->getRepairDate(), empty($repair->getRepairDate()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':kmAtRepair', $repair->getKmAtRepair(), empty($repair->getKmAtRepair()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':description', $repair->getDescription(), PDO::PARAM_STR);
    $this->stmt->bindValue(':location', $repair->getRepairLocation(), empty($repair->getRepairLocation()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':repairCost', $repair->getRepairCost(), empty($repair->getRepairCost()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':repairCostCurrency', $repair->getRepairCostCurrency(), empty($repair->getRepairCostCurrency()) ? PDO::PARAM_NULL : PDO::PARAM_INT);

    $this->stmt->execute();

    if ($this->stmt->rowCount() === 1) {
      $result = $repairID;
    } else {
      $result = -1;
    }
    $this->cleanUp();
    return $result;
  }

  private function updateRepair(RepairClass $repair) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "UPDATE repair_t SET
              repair_date = :repairDate,
              km_at_repair = :kmAtRepair,
              description = :description,
              repair_location = :repairLocation,
              repair_cost = :repairCost,
              repair_cost_currency = :repairCostCurrency
            WHERE repair_id = :repairID";

    $this->stmt = $this->conn->prepare($sql);

    $repairID = $repair->getRepairID();
    $this->stmt->bindValue(':repairDate', $repair->getRepairDate(), empty($repair->getRepairDate()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':kmAtRepair', $repair->getKmAtRepair(), empty($repair->getKmAtRepair()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':description', $repair->getDescription(), PDO::PARAM_STR);
    $this->stmt->bindValue(':repairLocation', $repair->getRepairLocation(), empty($repair->getRepairLocation()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':repairCost', $repair->getRepairCost(), empty($repair->getRepairCost()) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $this->stmt->bindValue(':repairCostCurrency', $repair->getRepairCostCurrency(), empty($repair->getRepairCostCurrency()) ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $this->stmt->bindValue(':repairID', $repairID, PDO::PARAM_INT);

    $this->stmt->execute();

    if ($this->stmt->rowCount() === 1) {
      $result = $repairID;
    } else {
      $result = -1;
    }
    $this->cleanUp();
    return $result;
  }

  public function deleteRepair($repairID) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "UPDATE repair_t SET
              deleted = 1
            WHERE repair_ID = :rID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':rID', $repairID, PDO::PARAM_INT);

    $this->stmt->execute();

    if ($this->stmt->rowCount() == 1) {
      $result = $repairID;
    } else {
      $result = -1;
    }
    //Close statement and connection
    $this->cleanUp();
    return $result;
  }

  private function listRepairPartCounts() {
    //Create connection to database
    $this->getConnection();
    //SQL for query
    $sql = "SELECT r.repair_id, COUNT(p.part_id) as part_count
            FROM repair_t r 
            INNER JOIN part_t p 
              ON r.repair_id = p.repair_id 
            GROUP BY repair_id";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->execute();

    $partCounts = array();
    $results = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $item) {
      $partCounts[$item['repair_id']] = $item['part_count'];
    }

    //Close statement and connection
    $this->cleanUp();
    //Return results
    return $partCounts;
  }

  public function listParts($repairID) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "SELECT p.part_id,
                   p.repair_id,
                   p.description,
                   p.part_number,
                   p.source,
                   p.brand,
                   p.part_cost,
                   p.part_cost_currency,
                   p.qty,
                   p.purchase_date,
                   e.create_datetime
             FROM part_t AS p
             INNER JOIN entities AS e
              ON e.entity_id = p.part_id
             WHERE p.deleted = 0 AND repair_ID = :rID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':rID', $repairID);

    $this->stmt->execute();

    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

    $parts = array();
    foreach ($result as $partRow) {
      $part = new PartClass($partRow);
      $part->setNotes($this->listNotes($part->getPartID()));
      $parts[] = $part;
    }
    $this->cleanUp();
    return $parts;
  }

  public function getPart($partID) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "SELECT p.part_id,
                   p.repair_id,
                   p.description,
                   p.part_number,
                   p.source,
                   p.brand,
                   p.part_cost,
                   p.part_cost_currency,
                   p.qty,
                   p.purchase_date,
                   e.create_datetime
            FROM part_t AS p
            INNER JOIN entities AS e
              ON e.entity_id = p.part_id
            WHERE p.part_id = :partID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':partID', $partID);

    $this->stmt->execute();

    $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
    $part = new PartClass($result);
    $part->setNotes($this->listNotes($partID));
    $this->cleanUp();
    return $part;
  }

  public function setPart(PartClass $part) {
    if ($part->getPartID()) {
      $partID = $this->updatePart($part);
    } else {
      $partID = $this->createPart($part);
    }
    if ($part->getNotes()) {
      $notes = $part->getNotes();
      foreach ($notes as $note) {
        $note->setParentID($partID);
      }
      $this->setNotes($notes);
    }
    return $partID;
  }

  private function createPart(PartClass $part) {
    $partID = $this->createEntity(4);
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "INSERT INTO part_t (
              part_id,
              repair_id,
              description,
              part_number,
              source,
              brand,
              part_cost,
              part_cost_currency,
              qty,
              purchase_date
            ) VALUES (
              :partID,
              :repairID,
              :description,
              :partNumber,
              :source,
              :brand,
              :partCost,
              :partCostCurrency,
              :qty,
              :purchaseDate
            )";

    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->bindValue(':partID', $partID, 1);
    $this->stmt->bindValue(':repairID', $part->getRepairID(), 1);
    $this->stmt->bindValue(':description', $part->getDescription(), 2);
    $this->stmt->bindValue(':partNumber', $part->getPartNumber(), empty($part->getPartNumber()) ? 0 : 2);
    $this->stmt->bindValue(':source', $part->getSource(), empty($part->getSource()) ? 0 : 2);
    $this->stmt->bindValue(':brand', $part->getBrand(), empty($part->getBrand()) ? 0 : 2);
    $this->stmt->bindValue(':partCost', $part->getPartCost(), empty($part->getPartCost()) ? 0 : 2);
    $this->stmt->bindValue(':partCostCurrency', $part->getPartCostCurrency(), empty($part->getPartCostCurrency()) ? 0 : 1);
    $this->stmt->bindValue(':qty', $part->getQty(), empty($part->getQty()) ? 0 : 1);
    $this->stmt->bindValue(':purchaseDate', $part->getPurchaseDate(), empty($part->getPurchaseDate()) ? 0 : 2);

    $this->stmt->execute();

    if ($this->stmt->rowCount() === 1) {
      $result = $partID;
    } else {
      $result = -1;
    }
    $this->cleanUp();
    return $result;
  }

  private function updatePart(PartClass $part) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "UPDATE part_t SET
              description = :description,
              part_number = :partNumber,
              source = :source,
              brand = :brand,
              part_cost = :partCost,
              part_cost_currency = :partCostCurrency,
              qty = :qty,
              purchase_date = :purchaseDate
            WHERE part_id = :partID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindValue(':description', $part->getDescription(), PDO::PARAM_STR);
    $this->stmt->bindValue(':partNumber', $part->getPartNumber(), empty($part->getPartNumber()) ? 0 : 2);
    $this->stmt->bindValue(':source', $part->getSource(), empty($part->getSource()) ? 0 : 2);
    $this->stmt->bindValue(':brand', $part->getBrand(), empty($part->getBrand()) ? 0 : 2);
    $this->stmt->bindValue(':partCost', $part->getPartCost(), empty($part->getPartCost()) ? 0 : 2);
    $this->stmt->bindValue(':partCostCurrency', $part->getPartCostCurrency(), empty($part->getPartCostCurrency()) ? 0 : 1);
    $this->stmt->bindValue(':qty', $part->getQty(), empty($part->getQty()) ? 0 : 1);
    $this->stmt->bindValue(':purchaseDate', $part->getPurchaseDate(), empty($part->getPurchaseDate()) ? 0 : 2);
    $this->stmt->bindValue(':partID', $part->getPartID(), PDO::PARAM_INT);

    $this->stmt->execute();

    if ($this->stmt->rowCount() === 1) {
      $result = $part->getPartID();
    } else {
      $result = -1;
    }
    $this->cleanUp();
    return $result;
  }

  public function deletePart($partID) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "UPDATE part_t SET
              deleted = 1
            WHERE part_ID = :partID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':partID', $partID, PDO::PARAM_INT);

    $this->stmt->execute();

    if ($this->stmt->rowCount() === 1) {
      $result = $partID;
    } else {
      $result = -1;
    }
    //Close statement and connection
    $this->cleanUp();
    return $result;
  }

  public function getAccountData($userID) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "SELECT * FROM users_t WHERE id = :uID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':uID', $userID, PDO::PARAM_INT);

    $this->stmt->execute();

    $result = $this->stmt->fetch(PDO::FETCH_ASSOC);

    $user = array(
        'id' => $result['id'],
        'firstname' => $result['firstName'],
        'lastname' => $result['lastName'],
        'email' => $result['email'],
        'password' => $result['password']
    );
    //Close statement and connection
    $this->cleanUp();
    return $result;
  }

  public function changePassword($userID, $password) {
    //Create connection to database
    $this->getConnection();

    //Create password hash
    $newPassword = md5($password);
    //Query SQL
    $sql = "UPDATE users_t SET password = :password WHERE id = :uID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':password', $newPassword, PDO::PARAM_STR);
    $this->stmt->bindParam(':uID', $userID, PDO::PARAM_INT);

    $this->stmt->execute();

    if ($this->stmt->rowCount() == 1) {
      $result = 1;
    } else {
      $result = -1;
    }
    $this->cleanUp();
    return $result;
  }

  public function getDueReminders() {
    //Create connection to database
    $this->getConnection();
    $today = date('Y-m-d');

    //Query SQL
    $sql = "SELECT * FROM reminder_t WHERE DATE(reminder_date) = :today";

    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->bindParam(":today", $today, PDO::PARAM_STR);

    $this->stmt->execute();

    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    $reminders = array();
    foreach ($result as $reminder) {
      $reminders[] = new ReminderClass($reminder);
    }

    //Close statement and connection
    $this->cleanUp();
    return $reminders;
  }

  public function listCurrencyData() {
    //Create connection to database
    $this->getConnection();
    //Query
    $sql = "SELECT currency_id,
                   currency_symbol,
                   html_entity,
                   currency_symbol_position
            FROM currencies";
    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->execute();
    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    $currencyData = array();
    foreach ($result as $item) {
      $currencyData[$item['currency_id']] = $item;
    }
    return $currencyData;
  }

  public function listReminders() {
    $userID = $_SESSION['user']['user_id'];
    require_once 'entity/reminder/ReminderClass.php';
    //Array to hold all reminders
    $reminders = array();
    //Create connection to database
    $this->getConnection();
    //SQL for query
    $sql = "SELECT r.reminder_id,
                   r.reminder_text,
                   e.create_datetime
            FROM reminders AS r
            INNER JOIN entities AS e
              ON e.entity_id = r.reminder_id
            WHERE r.deleted = 0 AND r.user_id = :userID
            ORDER BY e.create_datetime desc";

    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
    $this->stmt->execute();

    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $reminderRow) {
      $reminder = new ReminderClass($reminderRow);
      $reminder->setReminderDatetimes($this->listReminderDatetimes($reminder->getReminderID()));
      $reminder->setReminderEmails($this->listReminderEmails($reminder->getReminderID()));
      $reminders[] = $reminder;
    }

    $this->cleanUp();

    return $reminders;
  }

  private function listReminderDatetimes($reminderID) {
    require_once 'entity/reminder/ReminderDatetimeClass.php';
    //Array to hold all reminders
    $reminderDatetimes = array();
    //Create connection to database
    $this->getConnection();
    //SQL for query
    $sql = "SELECT rd.remind_datetime_id,
                   rd.reminder_id,
                   rd.remind_datetime,
                   rd.is_sent,
                   e.create_datetime
            FROM reminder_remind_datetimes AS rd
            INNER JOIN entities AS e
              ON e.entity_id = rd.remind_datetime_id
            WHERE rd.reminder_id = :reminderID
            ORDER BY rd.remind_datetime";

    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->bindParam(":reminderID", $reminderID, PDO::PARAM_INT);

    $this->stmt->execute();

    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $reminderDatetimeRow) {
      $reminderDatetime = new ReminderDatetimeClass($reminderDatetimeRow);
      $reminderDatetimes[] = $reminderDatetime;
    }

    $this->cleanUp();

    return $reminderDatetimes;
  }

  private function listReminderEmails($reminderID) {
    require_once 'entity/reminder/ReminderEmailClass.php';
    //Array to hold all reminders
    $reminderEmails = array();
    //Create connection to database
    $this->getConnection();
    //SQL for query
    $sql = "SELECT re.remind_email_id,
                   re.reminder_id,
                   re.email,
                   e.create_datetime
            FROM reminder_remind_emails AS re
            INNER JOIN entities AS e
              ON e.entity_id = re.remind_email_id
            WHERE re.reminder_id = :reminderID";

    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->bindParam(":reminderID", $reminderID, PDO::PARAM_INT);

    $this->stmt->execute();

    $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $reminderDatetimeRow) {
      $reminderEmail = new ReminderEmailClass($reminderDatetimeRow);
      $reminderEmails[] = $reminderEmail;
    }

    $this->cleanUp();

    return $reminderEmails;
  }

  public function setReminder(ReminderClass $reminder) {
    if ($reminder->getReminderID()) {
      $reminderID = $reminder->getReminderID();
      $this->updateReminder($reminder);
      $this->deleteReminderRemindDatetimes($reminder);
      $this->deleteReminderEmails($reminder);
    } else {
      $reminderID = $this->createReminder($reminder);
      $reminder->setReminderID($reminderID);
    }
    $this->setReminderRemindDatetimes($reminder);
    $this->setReminderEmails($reminder);

    return $reminderID;
  }

  private function createReminder(ReminderClass $reminder) {
    $reminderID = $this->createEntity(7);
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "INSERT INTO reminders (
              reminder_id,
              user_id,
              reminder_text
            ) VALUES (
              :reminderID,
              :userID,
              :reminderText
            )";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':reminderID', $reminderID, PDO::PARAM_INT);
    $this->stmt->bindValue(':userID', $reminder->getUserID(), PDO::PARAM_INT);
    $this->stmt->bindValue(':reminderText', $reminder->getReminderText(), PDO::PARAM_STR);

    if ($this->stmt->execute()) {
      $result = $reminderID;
    } else {
      $result = -1;
    }
    $this->cleanUp();
    return $result;
  }

  private function updateReminder(ReminderClass $reminder) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "UPDATE reminder SET
                   reminder_text = :reminderText
            WHERE reminder_id = :reminderID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindValue(':reminderText', $reminder->getReminderText(), PDO::PARAM_STR);
    $this->stmt->bindValue(':reminderID', $reminder->getReminderID(), PDO::PARAM_INT);
    if ($this->stmt->execute()) {
      $result = $reminder->getReminderID();
    } else {
      $result = -1;
    }

    $this->cleanUp();
    return $result;
  }

  private function deleteReminderRemindDatetimes(ReminderClass $reminder) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "DELETE FROM reminder_remind_datetimes
            WHERE reminder_id = :reminderID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindValue(':reminderID', $reminder->getReminderID(), PDO::PARAM_INT);

    $this->stmt->execute();

    //Close statement and connection
    $this->cleanUp();
  }

  private function deleteReminderEmails(ReminderClass $reminder) {
    //Create connection to database
    $this->getConnection();
    //Query SQL
    $sql = "DELETE FROM reminder_remind_emails
            WHERE reminder_id = :reminderID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindValue(':reminderID', $reminder->getReminderID(), PDO::PARAM_INT);

    $this->stmt->execute();

    //Close statement and connection
    $this->cleanUp();
  }

  private function setReminderRemindDatetimes(ReminderClass $reminder) {
    $reminderDatetimes = $reminder->getReminderDatetimes();
    $reminderID = $reminder->getReminderID();
    foreach ($reminderDatetimes as $reminderDatetime) {
      $remindDatetimeID = $this->createEntity(8);
      //Create connection to database
      $this->getConnection();
      //Query SQL
      $sql = "INSERT INTO reminder_remind_datetimes (
                remind_datetime_id,
                reminder_id,
                remind_datetime
              ) VALUES (
                :remindDatetimeID,
                :reminderID,
                :remindDatetime
              )";
      $this->stmt = $this->conn->prepare($sql);
      $this->stmt->bindParam(':remindDatetimeID', $remindDatetimeID, PDO::PARAM_INT);
      $this->stmt->bindParam(':reminderID', $reminderID, PDO::PARAM_INT);
      $this->stmt->bindValue(':remindDatetime', $reminderDatetime->getRemindDatetime(), PDO::PARAM_STR);
      $this->stmt->execute();
      $this->cleanUp();
    }
  }

  private function setReminderEmails(ReminderClass $reminder) {
    $reminderEmails = $reminder->getReminderEmails();
    $reminderID = $reminder->getReminderID();
    foreach ($reminderEmails as $reminderEmail) {
      $remindEmailID = $this->createEntity(9);
      //Create connection to database
      $this->getConnection();
      //Query SQL
      $sql = "INSERT INTO reminder_remind_emails (
                remind_email_id,
                reminder_id,
                email
              ) VALUES (
                :remindEmailID,
                :reminderID,
                :email
              )";
      $this->stmt = $this->conn->prepare($sql);
      $this->stmt->bindParam(':remindEmailID', $remindEmailID, PDO::PARAM_INT);
      $this->stmt->bindParam(':reminderID', $reminderID, PDO::PARAM_INT);
      $this->stmt->bindValue(':email', $reminderEmail->getEmail(), PDO::PARAM_STR);
      $this->stmt->execute();
      $this->cleanUp();
    }
  }

  public function getReminder($reminderID) {
    //Create connection to database
    $this->getConnection();

    $sql = "SELECT r.reminder_id,
                   r.user_id,
                   r.reminder_text,
                   e.create_datetime
            FROM reminders AS r
            INNER JOIN entities AS e
              ON r.reminder_id = e.entity_id
            WHERE r.reminder_id = :reminderID AND r.deleted = 0";
    $this->stmt = $this->conn->prepare($sql);
    $this->stmt->bindParam(':reminderID', $reminderID, PDO::PARAM_INT);
    
    $this->stmt->execute();

    $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
    $reminder = new ReminderClass($result);
    $reminder->setReminderDatetimes($this->listReminderDatetimes($reminderID));
    $reminder->setReminderEmails($this->listReminderEmails($reminderID));
    $this->cleanUp();
    return $reminder;
  }
  
  public function deleteReminder($reminderID) {
    //Create connection to database
    $this->getConnection();
    
    //Query SQL
    $sql = "UPDATE reminders SET
              deleted = 1
            WHERE reminder_id = :reminderID";

    $this->stmt = $this->conn->prepare($sql);

    $this->stmt->bindParam(':reminderID', $reminderID, PDO::PARAM_INT);

    $this->stmt->execute();

    if ($this->stmt->rowCount() == 1) {
      $result = $reminderID;
    } else {
      $result = -1;
    }
    //Close statement and connection
    $this->cleanUp();
    return $result;
  }
}
