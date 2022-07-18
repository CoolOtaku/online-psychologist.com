<?php
ini_set("display_errors",1);
include 'botHelper.php';

	$query = http_build_query(array("api_key" => "MTkyLjE2OC44OC4x"));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, "https://otaku-development.pp.ua/api/getTests");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    $response = curl_exec($ch);
    curl_close($ch);
	echo $response;
?>