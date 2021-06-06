<?php
/*  
 *  Responsible for receiving and storing data
 */

require_once('config.php');
require_once('caTracker.php');

// this sanitizes all gets/posts for security (prevent XSS)
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// create new object tracker
$tracker = new Tracker();

// check if parameters are attached
if(!empty($_GET)){
  try {

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
    // needed 11:22:33
    $tracker->setGPSTime(substr_replace(substr_replace(strtok($_GET['gpstime'],'.'), ':', 4, 0), ':',2,0));
    
    // set longitude (received as a String WGS 84)
    $tracker->setLonString(isset($_GET['lon']) ? $_GET['lon'] : NULL);
    
    // set latitude (received as a String WGS 84)
    $tracker->setLatString(isset($_GET['lat']) ? $_GET['lat'] : NULL);

    // gsm data
    $tracker->setGSM($_GET['gsm']);

  } catch (Exception $e) {
    error_log($e->getMessage());
    exit('Error with received data'); //something a user can understand
  }

}else{
  exit('No data attached');
}

// check if the tracker object has GPS data
if(!$tracker->validGPS()) exit('GPS data is not valid.');

// connect to DB
$dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", DBHOST, DBNAME, DBCHARSET);

$options = [
  // turn off emulation mode for "real" prepared statements
  PDO::ATTR_EMULATE_PREPARES   => false,
  // turn on errors in the form of exceptions
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  // make the default fetch be an associative array
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
  // creating the pdo object
  $pdo = new PDO($dsn, DBUSER, DBPASS, $options);

  // create table if not existing
  $tablename = "trackerdata_".$tracker->getSerial();
  $sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
    `datetime` DATETIME NOT NULL ,
    `gpstime` TIME NOT NULL ,
    `lat` DOUBLE NOT NULL ,
    `lon` DOUBLE NOT NULL ,
    `gsm` TEXT NULL ,
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB;";
  $request = $pdo->prepare($sql);
  $request->execute();

  // creating the SQL & exetuting
  $sql = "INSERT INTO `$tablename` (`id`, `datetime`, `gpstime`, `lat`, `lon`, `gsm`) VALUES (NULL, :datetime, :gpstime, :lat, :lon, :gsm)";
  $request = $pdo->prepare($sql);
  $data = [':datetime' => $tracker->getDateTime(),
           ':gpstime'  => $tracker->getGPSTime(),
           ':lat'      => $tracker->getLatDD(),
           ':lon'      => $tracker->getLonDD(),
           ':gsm'      => $tracker->getGSM()];
  $request->execute($data);

} catch (Exception $e) {
  error_log($e->getMessage());
  exit('Error occured: '.$e->getMessage()); //something a user can understand
}

echo "Data received & stored";

?>