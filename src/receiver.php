<?php
/*  
 *  Responsible for receiving and storing data
 * 
 *  GPS-Data: DMS (degrees, minutes, seconds)
 * 
 */
require_once('config.php');
require_once('caTracker.php');

// Latitude N (using S result has to be negated)
// Longitude E (using W result has to be negated)
function DMStoDD($deg,$min,$sec)
{
    // Converting DMS ( Degrees / minutes / seconds ) to decimal format
    return $deg+((($min*60)+($sec))/3600);
}

// lat NS ($dec>0 ? 'N' : 'S')
// lon EW ($dec>0 ? 'E' : 'W')
function DDtoDMS($dec)
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

var_dump((object)$_GET);

// Check if parameters are attached
if(!empty($_GET)){
  $object = new Tracker(2);
  foreach ($_GET as $key => $value){
    $object->$key = $value;
  }

  // serialnumber
  $object->$serial = $serial;
  // server datetime
  $object->$datetime = date('Y-m-d H:i:s');
  // gps time
  // example 112233.0
  // if no position information available 0.0
  // H: hour 00-23, with leading 0
  // i: minuts 00-59, with leading 0
  // s: seconds 00-59, with leading 0
  $object->$gpstime = substr_replace(substr_replace($timestamp, ':', 4, 0), ':',2,0);
  // get lat
  preg_match('/(.*)([G])([\d\.]+)([\'])([\d\.]+)([\']+)([NS])/', $_GET['lat'], $lat);
  $object->$lat = DMStoDD(substr($lat[3]*($match[4]=='N' ? 1 : -1));
  // get lon
  preg_match('/(.*)([G])([\d\.]+)([\'])([\d\.]+)([\']+)([EW])/', $_GET['lon'], $lon);
  $object->$lon = DMStoDD($match[5]*($match[6]=='E' ? 1 : -1));
  // gsm data
  $object->$gsm = $gsm;

}else{
  exit('No data attached');
}

var_dump($object);

// Connect to DB
$dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", DBHOST, DBNAME, DBCHARSET);

$options = [
  PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
];

try {
  $pdo = new PDO($dsn, DBUSER, DBPASS, $options);
} catch (Exception $e) {
  error_log($e->getMessage());
  exit('Error occured\n$e'); //something a user can understand
}

?>