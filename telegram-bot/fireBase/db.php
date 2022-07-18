<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

//$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'google-service-account.json');

$firebase = (new Factory)
	->withServiceAccount(__DIR__.'/google-service-account.json')
	->withDatabaseUri('https://onlinepsychologist-80165-default-rtdb.europe-west1.firebasedatabase.app');

$db = $firebase->createDatabase();

?>