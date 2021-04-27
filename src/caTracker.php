<?php
/*  
 *  Contains the structure of the Tracker-Object
 */

class caTracker{
  private $key;   // Tracker key
  private $time;  // Satellite Time
  private $lon;   // GPS Longitude
  private $lat;   // GPS Latitude
  private $gsm;   // GSM-Localization
  private $moni;  // MONI

  public function __construct(string $input){
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