<?php
/*  
 *  Contains the structure of the Tracker-Object
 */

class caTracker{
  private var $key;   // Tracker key
  private var $time;  // Satellite Time
  private var $lon;   // GPS Longitude
  private var $lat;   // GPS Latitude
  private var $gsm;   // GSM-Localization
  private var $moni;  // MONI

  public function __construct(string $input){
    $this->gsm = '';
  }
  public getGSM(){
    return $this->gsm;
  }
  public setGSM(int $_val){
    $this->gsm = $_val;
  }
  
}

?>