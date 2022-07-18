<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/router/router.php";
require_once $_SERVER['DOCUMENT_ROOT']."/api/db.php";
require_once $_SERVER['DOCUMENT_ROOT']."/api/api.php";
$url = key($_GET);

$_SESSION['ApiKey'] = base64_encode($_SERVER['REMOTE_ADDR']);
$_SESSION['db'] = $db;
if($_POST['api_key'] != $_SESSION['ApiKey']){
    exit('{"error":"Invalid api_key!"}');
}

$r = new Router();
$r->addRoute("getBooks", "modules/getBooks.php");
$r->addRoute("getTests", "modules/getTests.php");
$r->addRoute("getVideos", "modules/getVideos.php");
$r->addRoute("getTestsForSite", "modules/getTestsForSite.php");
$r->addRoute("getBooksForSite", "modules/getBooksForSite.php");
$r->addRoute("getVideosForSite", "modules/getVideosForSite.php");

$r->addRoute("verifyAdmin", "modules/verifyAdmin.php");
$r->addRoute("getAdministrators", "modules/getAdministrators.php");
$r->addRoute("addAdministrators", "modules/addAdministrators.php");
$r->addRoute("deleteAdministrators", "modules/deleteAdministrators.php");

$r->addRoute("addBooks", "modules/addBooks.php");
$r->addRoute("editBooks", "modules/editBooks.php");
$r->addRoute("deleteBooks", "modules/deleteBooks.php");

$r->addRoute("addTests", "modules/addTests.php");
$r->addRoute("editTests", "modules/editTests.php");
$r->addRoute("deleteTests", "modules/deleteTests.php");


$r->addRoute("addVideos", "modules/addVideos.php");
$r->addRoute("editVideos", "modules/editVideos.php");
$r->addRoute("deleteVideos", "modules/deleteVideos.php");

$r->route($url);
?>