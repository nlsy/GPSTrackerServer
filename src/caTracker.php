<?php
/*  
 *  Contains the structure of the Tracker-Object
 */

class Tracker{
  private $serial;    // Tracker key
  private $datetime;  // Server DateTime
  private $gpstime;   // Satellite Time
  private $lon;       // GPS Longitude (decimal degrees - World Geodetic System 84 (WGS 84))
  private $lat;       // GPS Latitude (decimal degrees - World Geodetic System 84 (WGS 84))
  private $gsm;       // GSM-Localization
  private $moni;      // MONI (#MONI: Cell BSIC LAC CellId ARFCN Power C1 C2 (TaRxQual PLMN))

  public function __construct($input){
    $this->gsm = '';
  }
  public function getGSM(){
    return $this->gsm;
  }
  public function setGSM($_val){
    $this->gsm = $_val;
  }
  
}

?>