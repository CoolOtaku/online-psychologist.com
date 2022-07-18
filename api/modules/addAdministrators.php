<?php 
$api = new Api(null);
if(isset($_POST)){
    $email = $_POST['email'];

    $res = mysqli_query($_SESSION['db'],"INSERT INTO `administrators` (`email`) VALUES ('$email')");
    if($res){
        $api->add('res', true);
    }else{
        $api->add('res', false);
    }
    $api->returnRes();
}
?>