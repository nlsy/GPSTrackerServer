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
  
  // Latitude N (using S result has to be negated)
  // Longitude E (using W result has to be negated)
  private function DMStoDD($_val)
  {
      // Converting DMS ( Degrees / minutes / seconds ) to decimal format
      $result = $_val['deg']+((($_val['min']*60)+($_val['sec']))/3600);
      return ($_val['dir']=='N'||$_val['dir']=='E' ? $result : $result*-1);
  }

  // lat NS ($dec>0 ? 'N' : 'S')
  // lon EW ($dec>0 ? 'E' : 'W')
  private function DDtoDMS($dec)
  {
      // Converts decimal format to DMS ( Degrees / minutes / seconds ) 
      $vars = explode(".",$dec);
      $deg = $vars[0];
      $tempma = "0.".$vars[1];

      $tempma = $tempma * 3600;
      $min = floor($tempma / 60);
      $sec = $tempma - ($min*60);

      return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
  }

  private function STRtoDMS($str)
  {
    preg_match('/(.*)([G])([\d\.]+)([\'])([\d\.]+)([\']+)([NSEW])/', $str, $result, 0);
    return array("deg"=>$result[1],"min"=>$result[3],"sec"=>$result[5],"dir"=>$result[7]);
  }

  private function DMStoSTR($_val)
  {
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
  public function getLonString(){
    $result = $this->DDtoDMS($this->lon);
    $result['dir'] = ($this->lon>0 ? 'N' : 'S');
    return $this->DMStoSTR($result);
  }
  public function setLonString($_val){
    $this->lon = $this->DMStoDD($this->STRtoDMS($_val));
  }

  // LonDMS
  public function getLonDMS(){
    $result = $this->DDtoDMS($this->lon);
    $result['dir'] = ($this->lon>0 ? 'N' : 'S');
    return $result;
  }
  // $_val = [$deg,$min,$sec,$dir]
  public function setLonDMS($_val){
    //$input = $this->DMStoDD($_val['deg'],$_val['min'],$_val['sec'],$_val['dir']);
    //$this->lon = ($_val['dir']=='N' ? $input : $input*-1);
    $this->lon = $this->DMStoDD($_val);
  }

  // LonDD
  public function getLonDD(){
    return $this->lon;
  }
  public function setLonDD($_val){
    $this->lon = $_val;
  }


  // LatString
  public function getLatString(){
    $result = $this->DDtoDMS($this->lat);
    $result['dir'] = ($this->lat>0 ? 'E' : 'W');
    return $this->DMStoSTR($result);
  }
  public function setLatString($_val){
    $this->lat = $this->DMStoDD($this->STRtoDMS($_val));
  }

  // LatDMS
  public function getLatDMS(){
    $result = $this->DDtoDMS($this->lat);
    $result['dir'] = ($this->lat>0 ? 'E' : 'W');
    return $result;
  }
  // $_val = [$deg,$min,$sec,$dir]
  public function setLatDMS($_val){
    //$input = $this->DMStoDD($_val['deg'],$_val['min'],$_val['sec'],$_val['dir']);
    //$this->lat = ($_val['dir']=='E' ? $input : $input*-1);
    $this->lat = $this->DMStoDD($_val);
  }

  // LatDD
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
  
}

?>