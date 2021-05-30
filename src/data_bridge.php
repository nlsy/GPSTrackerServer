<?php
/*  
 *  Data bridge between server and JavaScript on website
 */

require_once('config.php');
require_once('caTracker.php');

// this sanitizes all gets/posts for security (prevent XSS)
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$result = NULL;

// Connect to DB
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

  // creating the SQL & exetuting
  $tablename = "trackerdata_".(isset($_GET["key"]) ? $_GET["key"] : "");
  $request = $pdo->prepare("SELECT * FROM `$tablename` ORDER BY id ASC");
  $request->execute();
  $result = $request->fetchAll();

} catch (Exception $e) {
  error_log($e->getMessage());
  exit('Error occured'); //something a user can understand
}

// diplay data json encoded
echo json_encode($result);

?>