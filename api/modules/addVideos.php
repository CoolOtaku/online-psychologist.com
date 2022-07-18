<?php 
$api = new Api(null);
if(isset($_POST)){
    $video = $_POST['video'];

    $res = mysqli_query($_SESSION['db'],"INSERT INTO `videos` (`video_url`) VALUES ('".$video."')");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>