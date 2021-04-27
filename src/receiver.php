<?php
/*  
 *  Responsible for receiving and storing data
 */
require_once('config.php');
require_once('caTracker.php');

// Check if parameters are attached
if(!isset($_GET['key'])){
  header('Location:index.php');
}else{
  $key = $_GET['key'];
}


// Connect to DB
$dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", $host, $db, $charset);

$options = [
  PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
];
/*
try {
  $pdo = new PDO($dsn, $username, $password, $options);
} catch (Exception $e) {
  error_log($e->getMessage());
  exit('Something weird happened'); //something a user can understand
}

*/

?>