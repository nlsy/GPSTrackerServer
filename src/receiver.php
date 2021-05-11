<?php
/*  
 *  Responsible for receiving and storing data
 * 
 *  GPS-Data: DMS (degrees, minutes, seconds)
 * 
 */
require_once('config.php');
require_once('caTracker.php');

//var_dump((object)$_GET);

// Check if parameters are attached
if(!empty($_GET)){
  $tracker = new Tracker();
  //foreach ($_GET as $key => $value){
  //  $tracker->$key = $value;
  //}

  // serialnumber
  $tracker->setSerial(isset($_GET['serial']) ? $_GET['serial'] : NULL);

  // server datetime
  $tracker->setDateTime(date('Y-m-d H:i:s'));

  // gps time
  // example 112233.0
  // if no position information available 0.0
  // H: hour 00-23, with leading 0
  // i: minuts 00-59, with leading 0
  // s: seconds 00-59, with leading 0
  $tracker->setGPSTime(substr_replace(substr_replace(strtok($_GET['gpstime'],'.'), ':', 4, 0), ':',2,0));
  
  // get lon
  $tracker->setLonString($_GET['lon']);
  
  // get lat
  $tracker->setLatString($_GET['lat']);
  print($tracker->getLatString());

  // gsm data
  $tracker->setGSM($_GET);

}else{
  exit('No data attached');
}

print("<br><br>");
var_dump($tracker);

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
  exit('Error occured'); //something a user can understand
}

?>