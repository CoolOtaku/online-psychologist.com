<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/router/router.php";
$url = key($_GET);

session_start();
$_SESSION['ApiKey'] = base64_encode($_SERVER['REMOTE_ADDR']);

$r = new Router();
$r->addRoute("", "public/pages/home.php");
$r->addRoute("login", "public/pages/login.php");
$r->addRoute("admin", "public/pages/admin.php");

$r->route($url);
?>