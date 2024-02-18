<?php
$dbConn = new mysqli('localhost', 'twa370', 'twa370Vm', 'performancereview370');
if ($dbConn->connect_error) {
die('Connection error (' . $dbConn->connect_errno . ')'
. $dbConn->connect_error);
}
?>