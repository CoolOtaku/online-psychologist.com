<?php 
if(isset($_POST)){
	ReturnVideos();
}
function ReturnVideos(){
	$videos = mysqli_query($_SESSION['db'],"SELECT `video_url` FROM `videos`");
    $emparray = array();
    while($row = mysqli_fetch_assoc($videos)){
        $emparray[] = $row['video_url'];
    }
    $res = json_encode($emparray);
	exit($res);
}
?>