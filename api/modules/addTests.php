<?php 
$api = new Api(null);
if(isset($_POST)){
    $test = json_decode($_POST['test']);

    $res = mysqli_query($_SESSION['db'],"INSERT INTO `tests` (`title`, `img`, `url`) VALUES ('".$test->title."', '".$test->img."', '".$test->url."')");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>