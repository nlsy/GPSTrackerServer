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
  
  // Latitude N (using S result has to be negated)
  // Longitude E (using W result has to be negated)
  private function DMStoDD($_val)
  {
      if ($_val == NULL || !isset($_val['deg']) || !isset($_val['min']) || !isset($_val['sec']) || !isset($_val['dir'])) return NULL;
      // Converting DMS ( Degrees / minutes / seconds ) to decimal format
      $result = $_val['deg']+((($_val['min']*60)+($_val['sec']))/3600);
      return ($_val['dir']=='N'||$_val['dir']=='E' ? $result : $result*-1);
  }

  // lat NS ($dec>0 ? 'N' : 'S')
  // lon EW ($dec>0 ? 'E' : 'W')
  private function DDtoDMS($_val)
  {
      if ($_val == NULL) return NULL;
      // Converts decimal format to DMS ( Degrees / minutes / seconds ) 
      $vars = explode(".",$_val);
      $deg = (float)$vars[0];
      $tempma = "0.".$vars[1];

      $tempma = $tempma * 3600;
      $min = floor($tempma / 60);
      $sec = $tempma - ($min*60);

      return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
  }

  private function STRtoDMS($_val)
  {
    if ($_val == NULL) return NULL;
    $_val = filter_var($_val, FILTER_SANITIZE_STRING);
    preg_match('/(.*)([G])([\d\.]+)([&#39;]+)([\d\.]+)([&#39;]+)([NSEW])/', $_val, $result, 0);
    return array("deg"=>$result[1],"min"=>$result[3],"sec"=>$result[5],"dir"=>$result[7]);
  }

  private function DMStoSTR($_val)
  {
    if ($_val == NULL || !isset($_val['deg']) || !isset($_val['min']) || !isset($_val['sec']) || !isset($_val['dir'])) return NULL;
    return sprintf("%dG%d'%g''%s",$_val['deg'],$_val['min'],$_val['sec'],$_val['dir']);
  }


  public function __construct(){ }
  

  // Serial
  public function getSerial(){
    return $this->serial;
  }
  public function setSerial($_val){
    $this->serial = $_val;
  }
  

  // DateTime
  public function getDateTime(){
    return $this->datetime;
  }
  public function setDateTime($_val){
    $this->datetime = $_val;
  }

  // GPSTime
  public function getGPSTime(){
    return $this->gpstime;
  }
  public function setGPSTime($_val){
    $this->gpstime = $_val;
  }


  // LonString
  // e.g. lon: 10G38'43.8''E
  public function getLonString(){
    $result = $this->DDtoDMS($this->lon);
    $result['dir'] = ($this->lon>0 ? 'E' : 'W');
    return $this->DMStoSTR($result);
  }
  public function setLonString($_val){
    $this->lon = $this->DMStoDD($this->STRtoDMS($_val));
  }

  // LonDMS
  // e.g. lon: array(4){["deg"]=>float(10) ["min"]=>float(38), ["sec"]=>float(43.8) ["dir"]=>string(1)"E"}
  public function getLonDMS(){
    if ($this->lon == NULL) return NULL;
    $result = $this->DDtoDMS($this->lon);
    $result['dir'] = ($this->lon>0 ? 'E' : 'W');
    return $result;
  }
  // $_val = [$deg,$min,$sec,$dir]
  public function setLonDMS($_val){
    $this->lon = $this->DMStoDD($_val);
  }

  // LonDD
  // e.g. lon: 9.6538979
  public function getLonDD(){
    return $this->lon;
  }
  public function setLonDD($_val){
    $this->lon = $_val;
  }


  // LatString
  // e.g. lat: 50G48'29.4''N
  public function getLatString(){
    $result = $this->DDtoDMS($this->lat);
    $result['dir'] = ($this->lat>0 ? 'N' : 'S');
    return $this->DMStoSTR($result);
  }
  public function setLatString($_val){
    $this->lat = $this->DMStoDD($this->STRtoDMS($_val));
  }

  // LatDMS
  // e.g. lat: array(4){["deg"]=>float(50) ["min"]=>float(48), ["sec"]=>float(29.4) ["dir"]=>string(1)"N"}
  public function getLatDMS(){
    if ($this->lat == NULL) return NULL;
    $result = $this->DDtoDMS($this->lat);
    $result['dir'] = ($this->lat>0 ? 'N' : 'S');
    return $result;
  }
  // $_val = [$deg,$min,$sec,$dir]
  public function setLatDMS($_val){
    $this->lat = $this->DMStoDD($_val);
  }

  // LatDD
  // e.g. lat: 47.8141353
  public function getLatDD(){
    return $this->lat;
  }
  public function setLatDD($_val){
    $this->lat = $_val;
  }


  // GSM
  public function getGSM(){
    return $this->gsm;
  }
  public function setGSM($_val){
    $this->gsm = $_val;
  }


  // Check GPS data
  public function validGPS(){
    return (isset($this->lat) && isset($this->lon) ? true : false);
  }

  // Check GSM data
  public function validGSM(){
    return (isset($this->gsm) ? true : false);
  }
  
}

?>