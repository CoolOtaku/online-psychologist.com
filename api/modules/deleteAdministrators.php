<?php 
$api = new Api(null);
if(isset($_POST)){
    $id = $_POST['email'];
    $res = mysqli_query($_SESSION['db'],"DELETE FROM `administrators` WHERE `email` LIKE '$id'");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>