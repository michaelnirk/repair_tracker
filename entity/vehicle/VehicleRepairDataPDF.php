<?php
require_once 'include/fpdf183/fpdf.php';

class VehicleRepairDataPDF extends FPDF {
  private $vehicle;
  private $outputType;
  private $euroSymbol;
  private $y1;

  function __construct($vehicle, $outputType = 'I') {
    parent::__construct();
    $this->vehicle = $vehicle;
    $this->outputType = $outputType;
    $this->SetAutoPageBreak(true, 30);
    $this->euroSymbol = chr(128);
    $this->setTitle(utf8_decode($vehicle->getName()));
  }

  function Header() {
    $this->SetFont('Arial', 'B', 22);
    $this->Cell(0, 14, $this->vehicle->getName(), 0, 1, 'C');
    $this->Ln();
  }

  public function createPDF () {
    $this->AddPage();    
    $this->SetFont('Arial', 'B', 16);
    $this->Cell(0, 8, 'Vehicle Data', 0, 1);
    $this->SetLineWidth(0.2);
    $this->Line($this->GetX(), $this->GetY(), 195, $this->GetY());
    $this->Ln(2);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'Name:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $this->vehicle->getName(), 0, 0);
    $this->Cell(10, 6, '', 0, 0);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'Make:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $this->vehicle->getMake(), 0, 1);

    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'Model:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $this->vehicle->getModel(), 0, 0);
    $this->Cell(10, 6, '', 0, 0);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'Year:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $this->vehicle->getYear(), 0, 1);

    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'Key Code:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $this->vehicle->getKeyCode(), 0, 0);
    $this->Cell(10, 6, '', 0, 0);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'Date Purchased:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, date('d.m.Y', strtotime($this->vehicle->getDatePurchased())), 0, 1);

    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'KM at Purchase:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $this->vehicle->getKmAtPurchase(), 0, 0);
    $this->Cell(10, 6, '', 0, 0);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'Purchase Price:', 0, 0, 'R');
    $purchasePrice = $this->vehicle->getPurchasePrice() ? : '';
    $currencySymbol = '';
    if ($purchasePrice) {
      if ($this->vehicle->getPurchaseCurrency()) {
        $currencySymbol = $this->vehicle->getPurchaseCurrency() == 10050 ? $this->euroSymbol : '$';
      }
    }
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $currencySymbol . $purchasePrice, 0, 1);

    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'License Plate:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $this->vehicle->getLicensePlate(), 0, 0);
    $this->Cell(10, 6, '', 0, 0);
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'VIN:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    $this->Cell(55, 6, $this->vehicle->getVin(), 0, 1);

    $this->SetFont('Arial', 'B', 10);
    $this->Cell(30, 6, 'Vehicle Notes:', 0, 0, 'R');
    $this->SetFont('Arial', '', 10);
    if (count($this->vehicle->getNotes()) === 0) {
      $this->Cell(55, 6, "No Notes", 0, 1);
    } else {
      foreach($this->vehicle->getNotes() as $index => $note) {
        if ($index > 0) {
          $this->Cell(30, 6, '', 0, 0);
        }
        $this->MultiCell(0, 6, utf8_decode($note->getNoteText()));
        $this->Ln(2);
      }
    }

    //Repairs
    $this->Ln();
    $this->SetFont('Arial', 'B', 16);
    $this->Cell(0, 8, 'Vehicle Repairs', 0, 1);
    $this->SetLineWidth(0.2);
    $this->Line($this->GetX(), $this->GetY(), 195, $this->GetY());
    $this->Ln(2);
    if (count($this->vehicle->getRepairs()) === 0) {
      $this->SetFont('Arial', '', 10);
      $this->Cell(0, 6, "No Repairs", 0, 1);
    } else {
      foreach($this->vehicle->getRepairs() as $repair) {
        $this->y1 = $this->GetY();
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, 'Repair Date:', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, date('d.m.Y', strtotime($repair->getRepairDate())), 0, 1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, 'Repair Description:', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(0, 6, utf8_decode($repair->getDescription()), 0, 1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, 'KM / Mileage:', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, $repair->getKmAtRepair(), 0, 1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, 'Repair Location:', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 6, utf8_decode($repair->getRepairLocation()), 0, 1);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, 'Repair Cost:', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        $repairCost = $repair->getRepairCost() ? : '';
        $repairCostCurrencySymbol = '';
        if ($repairCost) {
          if ($repair->getRepairCostCurrency()) {
            $repairCostCurrencySymbol = $repair->getRepairCostCurrency() == 10050 ? $this->euroSymbol : '$';
          }
        }
        $this->Cell(0, 6, $repairCostCurrencySymbol . $repairCost, 0, 1);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(35, 6, 'Repair Notes:', 0, 0, 'R');
        $this->SetFont('Arial', '', 10);
        if (count($repair->getNotes()) === 0) {
          $this->Cell(55, 6, "No Notes", 0, 1);
        } else {
          foreach($repair->getNotes() as $index => $note) {
            if ($index > 0) {
              $this->Cell(35, 6, '', 0, 0);
            }
            $this->MultiCell(0, 6, utf8_decode($note->getNoteText()));
          }
        }

        $this->SetFont('Arial', 'B', 10);
        if (count($repair->getParts()) === 0) {
          $this->Cell(35, 6, 'Repair Parts:', 0, 0, 'R');
          $this->SetFont('Arial', '', 10);
          $this->Cell(0, 6, "No Repair Parts", 0, 1);
        } else {
          $this->Cell(35, 6, 'Repair Parts:', 0, 1, 'R');
          $this->SetFont('Arial', '', 10);
          foreach($repair->getParts() as $part) {
            $this->Cell(20, 6, '', 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(35, 6, 'Part Description:', 0, 0, 'R');
            $this->SetFont('Arial', '', 10);
            $this->MultiCell(0, 6, utf8_decode($part->getDescription()), 0, 'L');

            $this->Cell(20, 6, '', 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(35, 6, 'Part Number:', 0, 0, 'R');
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 6, utf8_decode($part->getPartNumber()), 0, 1);

            $this->Cell(20, 6, '', 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(35, 6, 'Part Source:', 0, 0, 'R');
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 6, utf8_decode($part->getSource()), 0, 1);

            $this->Cell(20, 6, '', 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(35, 6, 'Part Brand:', 0, 0, 'R');
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 6, utf8_decode($part->getBrand()), 0, 1);

            $this->Cell(20, 6, '', 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(35, 6, 'Part Price:', 0, 0, 'R');
            $this->SetFont('Arial', '', 10);
            $partCost = $part->getPartCost() ? : '';
            $partCostCurrencySymbol = '';
            if ($partCost) {
              if ($part->getPartCostCurrency()) {
                $partCostCurrencySymbol = $part->getPartCostCurrency() == 10050 ? $this->euroSymbol : '$';
              }
            }
            $this->Cell(0, 6, $partCostCurrencySymbol . $partCost, 0, 1);

            $this->Cell(20, 6, '', 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(35, 6, 'Quantity:', 0, 0, 'R');
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 6, utf8_decode($part->getQty()), 0, 1);

            $this->Cell(20, 6, '', 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(35, 6, 'Purchase Date:', 0, 0, 'R');
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 6, date('d.m.Y', strtotime($part->getPurchaseDate())), 0, 1);

            $this->Cell(20, 6, '', 0, 0);
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(35, 6, 'Part Notes:', 0, 0, 'R');
            $this->SetFont('Arial', '', 10);
            if (count($part->getNotes()) === 0) {
              $this->Cell(55, 6, "No Notes", 0, 1);
            } else {
              foreach($part->getNotes() as $index => $note) {
                if ($index > 0) {
                  $this->Cell(55, 6, '', 0, 0);
                }
                $this->MultiCell(0, 6, utf8_decode($note->getNoteText()));
              }
            }

            $this->Ln(8);
          }
        }
        $this->Ln(16);
      }      
    }

    
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(95, 6, $this->pdfData['name'], 0, 0);
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(40, 6, '', 0, 0, '');
    // $this->Cell(20, 6, 'Techniker:', 0, 0);
    // $this->SetFont('Arial', 'B', 8);
    // $this->Cell(35, 6, $this->pdfData['employee'], 0, 0);
    // $this->Ln();
    
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(95, 6, $this->pdfData['mailingstreet'], 0, 0);
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(40, 6, '', 0, 0, '');
    // $this->Cell(20, 6, 'Seriennummer:', 0, 0);
    // $this->SetFont('Arial', 'B', 8);
    // $this->Cell(35, 6, $this->pdfData['deviceid'], 0, 0);
    // $this->Ln();
    
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(95, 6, $this->pdfData['addressline'], 0, 0);
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(40, 6, '', 0, 0, '');
    // $this->Cell(20, 6, utf8_decode('Gerät:'), 0, 0);
    // $this->SetFont('Arial', 'B', 8);
    // $this->Cell(35, 6, $this->pdfData['devicename'], 0, 0);
    // $this->Ln();
    
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(95, 6, '', 0, 0);
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(40, 6, '', 0, 0, '');
    // $this->Cell(20, 6, 'GPS-Account:', 0, 0);
    // $this->SetFont('Arial', 'B', 8);
    // $this->Cell(35, 6, $this->pdfData['gpsaccountuserid'], 0, 0);
    // $this->Ln();

    // foreach($this->pdfData['additionalMetaItems'] as $additionalMetaItem) {
    //   $this->SetFont('Arial', 'B', 10);
    //   $this->Cell(95, 6, '', 0, 0);
    //   $this->SetFont('Arial', '', 7);
    //   $this->Cell(40, 6, '', 0, 0, '');
    //   $this->Cell(20, 6, $additionalMetaItem['item_title'] . ':', 0, 0);
    //   $this->SetFont('Arial', 'B', 8);
    //   $this->Cell(35, 6, $additionalMetaItem['item_value'], 0, 0);
    //   $this->Ln();
    // }
    
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(10, 6, 'E-Mail:', 0, 0);
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(0, 6, $this->pdfData['email'], 0, 0);
    // $this->Ln();
    
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(10, 6, 'Tel:', 0, 0);
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(0, 6, $this->pdfData['phone'], 0, 0);
    // $this->Ln();
    
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(10, 6, 'Fax:', 0, 0);
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(0, 6, $this->pdfData['fax'], 0, 0);
    // $this->Ln();
    
    // $this->Ln(15);
    // $this->SetFont('Arial', 'B', 12);
    // $this->Cell(0, 6, 'zugeordneter Betreff / Fehlerbeschreibung / Dienstleistung', 0, 1);
    // $this->SetFont('Arial', '', 10);
    // $this->MultiCell(0, 5, $this->pdfData['title'], 0);
    // $this->Ln(2);
    
    // $this->SetLineWidth(0.5);
    // $this->Line($this->GetX(), $this->GetY(), 200, $this->GetY());
    
    // $this->Ln(8);
    // $this->SetFont('Arial', 'B', 12);
    // $this->Cell(0, 6, 'Verwendetes Material', 0, 1);
    // $this->SetFont('Arial', '', 10);
    // $this->MultiCell(0, 5, $this->pdfData['description'], 0);
    // $this->Ln(2);
    
    // $this->SetLineWidth(0.5);
    // $this->Line($this->GetX(), $this->GetY(), 200, $this->GetY());
    
    // $this->Ln(8);
    // $this->SetFont('Arial', 'B', 12);
    // $this->Cell(0, 6, utf8_decode($this->pdfData['tasksPerformed']), 0, 1);
    // $this->SetFont('Arial', '', 10);
    // $this->MultiCell(0, 5, $this->pdfData['solution'], 0);
    // $this->Ln(2);
    
    // $this->SetLineWidth(0.5);
    // $this->Line($this->GetX(), $this->GetY(), 200, $this->GetY());
    
    // $this->Ln(8);
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(20, 6, utf8_decode('Benötigte Arbeitszeit:'), 0, 0);
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(75, 6, $this->pdfData['hours'], 0, 0, 'C');
    // $this->SetFont('Arial', '', 7);
    // $this->Cell(20, 6, utf8_decode('Gefahrene Kilometer:'), 0, 0);
    // $this->SetFont('Arial', 'B', 10);
    // $this->Cell(75, 6, $this->pdfData['km'], 0, 1, 'C');
    // $this->Ln(2);
    // $this->SetLineWidth(0.5);
    // $this->Line($this->GetX(), $this->GetY(), 200, $this->GetY());

    // foreach($this->pdfData['additionalContentItems'] as $additionalContent) {
    //   $this->Ln(4);
    //   $this->SetFont('Arial', '', 10);
    //   $this->Cell(0, 6, utf8_decode($additionalContent), 0, 1);
    //   $this->Ln(2);
    //   $this->SetLineWidth(0.5);
    //   $this->Line($this->GetX(), $this->GetY(), 200, $this->GetY());
    // }
    
    // $this->Ln(6);
    // $this->SetFont('Arial', '', 6);
    // $this->MultiCell(0, 4, utf8_decode($this->pdfData['footerText']), 0); 
    
    // $fileName = $this->pdfData['departmentTitle'] . $this->pdfData['supportReportID'] . ".pdf";
    // $this->Output($this->outputType, "$fileName", "$fileName");
    // return $this->pdfData['supportReportID'];
    $this->Output($this->outputType, "test.pdf");
  }

  function Output($dest='', $name='', $isUTF8=false) {
    // Output PDF to some destination
    $this->Close();
    if(strlen($name)==1 && strlen($dest)!=1) {
      // Fix parameter order
      $tmp = $dest;
      $dest = $name;
      $name = $tmp;
    }

    if($dest=='') {
      $dest = 'I';
    }

    if($name=='') {
      $name = 'doc.pdf';
    }

    switch(strtoupper($dest)) {
      case 'I':
        // Send to standard output
        $this->_checkoutput();
        if(PHP_SAPI!='cli') {
          // We send to a browser
          header('Content-Type: application/pdf');
          header('Content-Disposition: inline; '.$this->_httpencode('filename',$name,$isUTF8));
          header('Cache-Control: private, max-age=0, must-revalidate');
          header('Pragma: public');
        }
        echo $this->buffer;
        break;
      case 'D':
        // Download file
        $this->_checkoutput();
        header('Content-Type: application/x-download');
        header('Content-Disposition: attachment; '.$this->_httpencode('filename',$name,$isUTF8));
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        echo $this->buffer;
        break;
      case 'F':
        // Save to local file
          $tmpPath = stream_resolve_include_path(FPDF_TEMP_FOLDER);
          $filename = "$tmpPath/$name";
        if(!file_put_contents($filename, $this->buffer)) {
          $this->Error('Unable to create output file: ' . $name);
        }
        break;
      case 'S':
        // Return as a string
        return $this->buffer;
      default:
        $this->Error('Incorrect output destination: ' . $dest);
      }
    return '';
  } 

}