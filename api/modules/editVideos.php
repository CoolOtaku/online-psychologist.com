<?php 
$api = new Api(null);
if(isset($_POST)){
    $video = json_decode($_POST['video']);

    $res = mysqli_query($_SESSION['db'],"UPDATE `videos` SET `video_url` = '".$video->video_url."' WHERE `id` = $video->id");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>