<?php 
$api = new Api(null);
if(isset($_POST)){
    $id = $_POST['id'];

    $res = mysqli_query($_SESSION['db'],"DELETE FROM `tests` WHERE `id` = $id");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>