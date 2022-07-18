<?php 
$api = new Api(null);
if(isset($_POST)){
    $test = json_decode($_POST['test']);

    $res = mysqli_query($_SESSION['db'],"UPDATE `tests` SET `img` = '".$test->img."', `title` = '".$test->title."', `url` = '".$test->url."' WHERE `id` = $test->id");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>