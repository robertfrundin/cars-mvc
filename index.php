<?php
require_once('requestHandler.php');

$handler=new requestHandler('list.json');
$handler->handleRequest();

?>