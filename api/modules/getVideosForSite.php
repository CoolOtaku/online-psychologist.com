<?php 
if(isset($_POST)){
	ReturnVideos();
}
function ReturnVideos(){
	$videos = mysqli_query($_SESSION['db'],"SELECT * FROM `videos`");
    $emparray = array();
    while($row = mysqli_fetch_assoc($videos)){
        $emparray[] = $row;
    }
    $res = json_encode($emparray);
	exit($res);
}
?>